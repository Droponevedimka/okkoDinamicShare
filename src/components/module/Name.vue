<template lang="pug">
    section(class="name") 
      div(class="name__title") Осталось ввести&nbsp;имена 
      form(ref="form" class="name__form" @submit="toResult")
        input(ref="myName" v-on:change="changeInput" type="text" placeholder="Ваше имя" min-length="2" onkeydown="if (event.key == '@') return false" max-length="19" class="name__form-input" required)
        input(ref="friendName" v-on:change="changeInput" type="text" placeholder="Имя друга" min-length="2" onkeydown="if (event.key == '@') return false" max-length="19" class="name__form-input" required)
        input(class="name__form-btn"  type="submit" value="Получить билеты" v-on:click="toCorrect") 
            
     
</template>


<script>

export default {
  data(){
      return {
          
      }
  },
  components: {

  },
  methods: {    
      toResult(e){
          e.preventDefault()
          window.toResult.myName = this.$refs.myName.value
          window.toResult.friendName = this.$refs.friendName.value

          ga('send', {
            hitType: 'event',
            eventCategory: 'Quiz_May_2020',
            eventAction: 'get_tickets',
            eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
          });
          window.dataLayer = window.dataLayer || []
            dataLayer.push({
              event: 'quiz_may_2020',
              details: {
                step: 'get_tickets'
              }
          })


          this.$router.push({path: "/final", query: {where: window.toResult.where, with: window.toResult.with, myName: this.$refs.myName.value, friendName: this.$refs.friendName.value}})
          
      },
      toCorrect(){
        if(this.$refs.myName.value.length < 2) this.$refs.myName.style.borderBottom = '1px solid rgba(255,0,0,0.7)'
        if(this.$refs.friendName.value.length < 2) this.$refs.friendName.style.borderBottom = '1px solid rgba(255,0,0,0.7)'
      },
      changeInput(e){       
        if(e.target.value.length < 2) { 
            e.target.style.borderBottom = '1px solid rgba(255,0,0,0.7)'
          } else {
            e.target.style.borderBottom = '1px solid rgba(0,255,0,0.7)'
          }
      }
  },
  mounted() {                
        
  },
  beforeMount(){


      }

}

</script>
