<template lang="pug">
    section(class="who") 
        div(ref="who" class="who__block") 
            div(class="who__block-title") А с кем?
            div(class="who__block-items")
                div(class="who__block-items-item" v-for="item of toWhere" v-on:click="goVisName(item.id, item.shareTxt)" :class="{'active': item.id == active}")
                    img(:src="`/assets/img/who/${item.img}`" class="who__block-items-item-img")
                    img(v-if="item.transform" :src="`/assets/img/who/${item.imgMob}`" class="who__block-items-item-img-mob")
                    div(class="who__block-items-item-txt" :class="{'two' : item.id == 2}" v-html="item.txt") 
                    img(v-if="!item.transform" :src="`/assets/img/who/${item.imgMob}`" class="who__block-items-item-img-mob")
        toName(v-show="visName")
    
</template>


<script>
import Name from './module/Name.vue'

export default {
  data(){
      return {
          visName: false,
          active: 0,
          toWhere: [
              {
                id: 1,
                txt: 'Со второй<br>половинкой',
                img: 'lips.png',
                imgMob: 'lips-mob.svg',
                shareTxt: 'mate'
              },
              {
                id: 2,
                txt: 'С другом<br>&nbsp;',
                img: 'piece.png',
                imgMob: 'piece-mob.svg',
                transform: true,
                shareTxt: 'with_friend'
              },
              {
                id: 3,
                txt: 'С кем-то<br>из родных',
                img: 'heart.png',
                imgMob: 'heart-mob.svg',
                shareTxt: 'relative'
              }
          ]
      }
  },
  components: {
    'toName' : Name
  },
  methods: {    
      goVisName(e, meta){          
          window.toResult.with = e    
          
          document.getElementById('transition').style.height = 'auto'           
          if(this.active < 1){
              this.visName = true
                setTimeout(() => {
                    window.scrollTo({
                      top: this.$refs.who.offsetHeight,
                      left: 0,
                      behavior: 'smooth'
                    })
                  
                }, 150)
          } 
          this.active = e  

          ga('send', {
            hitType: 'event',
            eventCategory: 'Quiz_May_2020',
            eventAction: `Step3_${meta}`, // Опция, которую выбрал пользователь. Варианты: mate; with_friend, relative;
            eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
          });
          window.dataLayer = window.dataLayer || []
            dataLayer.push({
              event: 'quiz_may_2020',
              details: {
                step: 'step3',
                option: `_${meta}` // Опция, которую выбрал пользователь. Варианты: mate; with_friend, relative;
              }
          })

      }
  },
  mounted() {                
        document.getElementById('transition').style.height = '100%'
        setTimeout(() => {
                    window.scrollTo({
                      top: 0,
                      left: 0,
                      behavior: 'smooth'
                    })
                  
                }, 150)
  },
  beforeMount(){


      }

}
</script>
