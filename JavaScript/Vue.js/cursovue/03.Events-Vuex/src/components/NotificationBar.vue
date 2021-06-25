 <template>
      <div class="notification-bar" 
            :class="notificationTypeClass"> <!-- binding computed property here  -->
        <p>{{ notification.message }}</p>
      </div>
    </template>
    
    <script>
    import { mapActions } from 'vuex'
    export default {
      props: {
        notification: {
          type: Object,
          required: true
        }
      },
      data() {
        return {
          timeout: null
        }
      },
      mounted() {
        this.timeout = setTimeout(() => this.remove(this.notification), 5000)
      },
      methods: mapActions('notification', ['remove']),
      beforeDestroy() {
        clearTimeout(this.timeout) //clear timeout running
      },
      computed: {
        notificationTypeClass() {
          return `-text-${this.notification.type}`
        }
    }
    }
    </script>
    
    <style scoped>
    .notification-bar {
      margin: 1em 0 1em;
    }
    </style>