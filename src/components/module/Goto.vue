<template lang="pug">
    section(class="goto") 
      div(class="goto__title") Куда идём?
      div(class="goto__items")
        div(class="goto__items__item" v-for="item of itemsData" v-on:click="toWho(item.id, item.meta)")            
            div(class="goto__items__item-block")
                img(:src="`/assets/img/home/${item.img}`" class="goto__items__item-block-img")
                img(:src="`/assets/img/home/${item.imgMob}`" class="goto__items__item-block-img-mob")
                div(class="goto__items__item-block-txt")
                    div(class="goto__items__item-block-txt-title") {{item.title}}
                    div(class="goto__items__item-block-txt-desc") {{item.desc}}
            div(class="goto__items__item-arrow")
                img(src="/assets/img/home/arrow-right.svg" class="goto__items__item-arrow-img")
      
            
     
</template>


<script>

export default {
  name: 'Goto',
  data(){
      return {
          itemsData: [
              { 
                id: 1,
                title: 'Кино',
                desc: 'Успеете на любой сеанс',
                img: 'popcorn.png',
                imgMob: 'popcorn-mob.svg',
                meta: 'kino'
              },
              { 
                id: 2,
                title: 'Фитнес',
                desc: 'Можно подтянуть кого угодно',
                img: 'gum.png',
                imgMob: 'gum-mob.svg',
                meta: 'fitness'
              },
              { 
                id: 3,
                title: 'Концерт',
                desc: 'Чтобы даже соседям понравилось',
                img: 'rock.png',
                imgMob: 'rock-mob.svg',
                meta: 'concert'
              },
              { 
                id: 4,
                title: 'Выставка',
                desc: 'Не занимать вдохновения и очередей',
                img: 'banana.png',
                imgMob: 'banana-mob.svg',
                meta: 'exhibition'
              },
              { 
                id: 5,
                title: 'Путешествие',
                desc: 'Куда-то дальше кухни',
                img: 'palm.png',
                imgMob: 'palm-mob.svg',
                meta: 'travel'
              },
          ]
      }
  },
  components: {
    
  },
  methods: {    
      toWho(e,meta){
          window.toResult.where = e
          ga('send', {
            hitType: 'event',
            eventCategory: 'Quiz_May_2020',
            eventAction: `Step2_${meta}`, // Опция, которую выбрал пользователь. Варианты: fitness; kino; concert; exhibition; travel
            eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
          });
          window.dataLayer = window.dataLayer || []
            dataLayer.push({
              event: 'quiz_may_2020',
              details: {
                step: 'step2',
                option: meta // Опция, которую выбрал пользователь. Варианты: fitness; kino; concert; exhibition; travel
              }
          })

          this.$router.push({path: "/who"})
      }
  },
  mounted() {                
        
  },
  beforeMount(){


      }

}
</script>