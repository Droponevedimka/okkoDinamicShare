<template lang="pug">
    section(ref="qwe" class="home") 
      div(ref="home" class="home__main")
        div(class="home__main__left") 
          div(class="home__main__left-block")
            a(href="https://okko.tv/?utm_source=quiz&utm_medium=refferal&utm_campaign=kinoafisha" class="home__main__left-block-img" target="blank")
              img(src="/assets/img/logo.svg" class="home__main__left-block-img")
            div(class="home__main__left-block-title") Есть планы?<br>Реализуйте с&nbsp;Okko!
            div(class="home__main__left-block-desc") Любимые места скучают по&nbsp;вам. Посетите их вместе с&nbsp;близкими <span>онлайн</span>&nbsp;&mdash; выберите, куда и&nbsp;с&nbsp;кем вы пойдете сегодня, а&nbsp;мы&nbsp;все устроим.
            div(class="home__main__left-block-arrow" v-on:click="changeVis")
              div(class="home__main__left-block-arrow-btn") ИДЕМ!
        div(class="home__main__right") 
          img(src="/assets/img/home/mainR.svg" class="home__main__right-img")
          div(class="home__main__right-arrow" v-on:click="changeVis")
            div(class="home__main__right-arrow-btn") ИДЕМ!
      Other(v-show="visOther" id="goto" )
            
     
</template>


<script>
import Goto from './module/Goto.vue'

export default {
  data(){
      return {
          visOther: false
      }
  },
  components: {
    'Other' : Goto
  },
  computed: {
    
  },
  methods: {    
      changeVis(){
        this.visOther = true
        // document.getElementById('transition').style.height = 'auto'
          
        setTimeout(() => {         
            window.location.hash="goto";
            document.getElementById("goto").scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            })            
        }, 200)

        ga('send', {
          hitType: 'event',
          eventCategory: 'Quiz_May_2020',
          eventAction: 'Step1',
          eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
        });
        window.dataLayer = window.dataLayer || []
          dataLayer.push({    event: 'quiz_may_2020',
            details: {
              step: 'step1'
            }
        })

        
      }
  },
  mounted() {        
        let self = this 

        window.addEventListener("scroll", function(e) {      
          if(!self.visOther){            
            if(window.scrollY+1 >= document.documentElement.scrollHeight-document.documentElement.clientHeight){
              self.changeVis()                 
            }
          }          
        })

        
  }
}

</script>
