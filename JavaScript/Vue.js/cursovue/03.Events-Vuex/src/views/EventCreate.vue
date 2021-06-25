<template>
  <div>
    <h1>Create an Event</h1>
     <form @submit.prevent="createEvent">
        <label>Select a category</label>
        <select v-model="event.category">
          <option v-for="cat in categories" :key="cat">{{ cat }}</option>
        </select>
        <h3>Name  & describe your event</h3>
        <div class="field">
          <label>Title</label>
          <input v-model="event.title" type="text" placeholder="Add an event title"/>
        </div>
        <div class="field">
          <label>Description</label>
          <input v-model="event.description" type="text" placeholder="Add a description"/>
        </div>
        <h3>Where is your event?</h3>
        <div class="field">
          <label>Location</label>
          <input v-model="event.location" type="text" placeholder="Add a location"/>
        </div>
        <h3>When is your event?</h3>
        <div class="field">
          <label>Date</label>
          <datepicker v-model="event.date" placeholder="Select a date"/>
        </div>
        <div class="field">
          <label>Select a time</label>
          <select v-model="event.time">
            <option v-for="time in times" :key="time">{{ time }}</option>
          </select>
        </div>
        <input type="submit" class="button -fill-gradient" value="Submit"/>
      </form>
     
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default {
  components: {
    Datepicker
  },
  data() {
    const times = []
    for (let i = 1; i <= 24; i++) {
      times.push(i + ':00') //filling times array
    }
    return {
      event: this.createFreshEventObject(), //Instead of putting an event object in our data directly, we’re calling a method that generates a fresh event object whenever this component is created.
      times,
      categories: this.$store.state.categories,
    }
  },
  methods: {
    createFreshEventObject() {
      const user = this.$store.state.user.user
      const id = Math.floor(Math.random() * 10000000)
      return {
        id: id,
        category: '', 
        organizer: user,
        title: '',
        description: '',
        location: '',
        date: '',
        time: '',
        attendees: []
      }
    },
    createEvent() {
      this.$store.dispatch('event/createEvent', this.event) //Dispatch event that is in store
       .then(() => {
         this.$router.push({ //to redirect the user to the event page
            name: 'event-show',
            params: { id: this.event.id }
          })
          this.event = this.createFreshEventObject() //to reset the component after event return
        })
    },
  },
  computed: {
    /*catLength() {
      return this.$store.getters.catLength
    },*/
    /*getEvent() {
      return this.$store.getters.getEventById
    }, or use mapGetters*/
    //...mapGetters(['getEventById']),
    //...mapState(['categories', 'user']) //... is to te possible to add other methods inside computed
  }
    /*userName() {
      return this.$store.state.user.name //I have to use this to access store in this case
    }, this is for h1 to work:
    <!-- <h1>Create Event, {{ userName }}</h1>
    <h1>Create Event, {{ $store.state.user.name }}</h1> -->
    */
   /*
    mapState({
      userName: state => state.user.name,
      categories: 'categories' // <-- simplified syntax for top-level State, equals to "categories: state => state.categories"
    })
    With this I can access like this: <h1>Create Event, {{ userName }}</h1>
    Or all of this can be changed to mapState*/
}
</script>

<style scoped>
  .field {
    margin-bottom: 24px;
  }
</style>