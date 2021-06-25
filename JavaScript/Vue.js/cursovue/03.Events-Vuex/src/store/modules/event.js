import EventService from '@/services/EventService.js'

export const namespaced = true
    
export const state = {
  events: [],
  eventsTotal: 0,
  event: {}
}
export const mutations = {
    ADD_EVENT(state, event) { //Mutations in general are upper case
        state.events.push(event)
    },
    SET_EVENTS(state, events) {
        state.events = events //Mutation sets all the events
    },
    SET_EVENTS_TOTAL(state, eventsTotal) {
        state.eventsTotal = eventsTotal
    },
    SET_EVENT(state, event) { //Mutation to set event
        state.event = event
    }
}
export const actions = {
    createEvent({ commit, dispatch }, event) {
        return EventService.postEvent(event)
        .then(() => {
          commit('ADD_EVENT', event)
          const notification = {
            type: 'success',
            message: 'Your event has been created!'
          }
          dispatch('notification/add', notification, { root: true })
        })
        .catch(error => {
            const notification = {
              type: 'error',
              message: 'There was a problem creating your event: ' + error.message
            }
            dispatch('notification/add', notification, { root: true })
            throw error
          })
        },
        fetchEvents({ commit, dispatch }, { perPage, page }) { //calls our EventService and then calls our Mutation (SET_EVENTS).  The second argument with both mutations and actions is effectively a payload
            EventService.getEvents(perPage, page)
                .then(response => {
                    commit('SET_EVENTS_TOTAL',parseInt(response.headers['x-total-count']))
                    commit('SET_EVENTS', response.data)
            })
            .catch(error => {
                const notification = {
                    type: 'error',
                    message: 'There was a problem fetching events: ' + error.message
                }
                dispatch('notification/add', notification, { root: true }) //look for a notification/add action at the root of our store, instead of just looking for it inside the module we’re currently in.
            })
        },
        fetchEvent({ commit, getters, dispatch }, id) { //Send in the getters
        var event = getters.getEventById(id) // See if we already have this event

        if (event) {// If we do, set the event
            commit('SET_EVENT', event)
        } else {// If not, get it with the API.
            EventService.getEvent(id)
            .then(response => {
                commit('SET_EVENT', response.data)
            })
            .catch(error => {
                const notification = {
                    type: 'error',
                    message: 'There was a problem fetching an event: ' + error.message
                  }
                  dispatch('notification/add', notification, {
                    root: true
                  })
            })
        }
        
        }
}

export const getters = {
  /*catLength: state => {
    return state.categories.length
  },
  doneTodos: (state) => {
    return state.todos.filter(todo => todo.done) //Get array of todos done
  },
  activeTodosCount: (state, getters) => {
    return state.todos.filter(todo => !todo.done).length
    //or can be this way: return state.todos.length - getters.doneTodos.length
  },*/
  getEventById: state => id => {
    return state.events.find(event => event.id === id)
  }
}