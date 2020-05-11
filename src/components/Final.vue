<template lang="pug">
    section(class="final")        
      div(class="final__top")
        div(class="final__top-block")
          div(class="final__top-block-title" v-html="toResult.title")
          a(href="https://okko.tv/?utm_source=quiz&utm_medium=refferal&utm_campaign=kinoafisha" class="final__top-block-logo" target="blank")
            img(src="/assets/img/logo.svg" class="final__top-block-logo-img")
        div(class="final__top-desc" v-html="toResult.desc")

      div(class="final__body-title" v-html="activeMe ? 'Ваш билет:' : toTicket.txt")
      div(class="final__body")
        
        div(class="final__body-block")
          div(class="final__body-block-who")

            div(class="final__body-block-who-title" v-html="toTicket.txt")
            div(class="final__body-block-friend" :class="{'active' : activeFriend, 'round' : toResult.round}")
              img(:src="`/assets/img/final/ticket-friend-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="final__body-block-friend-desc")
              img(:src="`/assets/img/final/ticket-friend-mob-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="final__body-block-friend-mob")
              div(class="final__body-block-friend-left")
                div(class="final__body-block-title" v-html="toResult.friendTicket")
                div(class="final__body-block-name") {{params.friendName}}
                div(class="final__body-block-option")
                  div(class="final__body-block-option-left") Место:
                  div(class="final__body-block-option-right") онлайн-кинотеатр Okko
                div(class="final__body-block-option")
                  div(class="final__body-block-option-left") Время:
                  div(class="final__body-block-option-right") когда удобно ☺️
                div(class="final__body-block-option")
                  div(class="final__body-block-option-left") Приглашает:
                  div(class="final__body-block-option-right") {{params.myName}}
                div(class="final__body-block-option mob")
                    div(class="final__body-block-option-right") Твой промокод: <span class="promo">{{promocode}}</span>
                    
              div(class="final__body-block-friend-right")
               
                  div(class="final__body-block-friend-right-title") Поделиться <span>билетом</span> с другом:
                  div(class="final__body-block-friend-right-socs")
                    a(:href="`whatsapp://send?text=${toShareUri}`" target="blank" @click="socSher(false)" class="final__body-block-friend-right-socs-link")
                      img(src="/assets/img/final/vib-share.svg" class="final__body-block-friend-right-socs-link-img")
                    a(:href="`tg://msg?text=${toShareUri}`" target="blank" @click="socSher(false)" class="final__body-block-friend-right-socs-link tg")
                      img(src="/assets/img/final/tg-share.svg" class="final__body-block-friend-right-socs-link-img")
            
            div(class="final__body-block-who-title" ) Ваш билет:
            div(class="final__body-block-me" :class="{'active' : activeMe, 'round' : toResult.round}")
              img(:src="`/assets/img/final/${toResult.round ? 'ticket-friend-2' : 'ticket-friend-1'}.png`" class="final__body-block-me-desc")
              img(:src="`/assets/img/final/ticket-me-mob-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="final__body-block-me-mob")
              div(class="final__body-block-me-left" :class="{'round' : toResult.round}")
                img(:src="`/assets/img/final/ticket-me-left-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="final__body-block-me-left-desc" )
                div(class="final__body-block-me-left-block")
                  div(class="final__body-block-title" v-html="toResult.myTicket")
                  div(class="final__body-block-name") {{params.myName}}
                  div(class="final__body-block-option")
                    div(class="final__body-block-option-left") Место:
                    div(class="final__body-block-option-right") онлайн-кинотеатр Okko
                  div(class="final__body-block-option")
                    div(class="final__body-block-option-left") Время:
                    div(class="final__body-block-option-right") когда удобно ☺️
                  div(class="final__body-block-option desk")
                    div(class="final__body-block-option-left") Ваш промокод:
                    div(ref="promo" id="promo" class="final__body-block-option-right promocode") {{promocode}}
                  div(class="final__body-block-option mob margin")
                    div(class="final__body-block-option-right") Мой промокод: <span class="promo">{{promocode}}</span>
              div(ref="ticketCheck" class="final__body-block-me-right" :class="{'round' : toResult.round}")
                img(:src="`/assets/img/final/ticket-me-right-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="final__body-block-me-right-desc" )
                div( v-on:click="copyPromo()" class="final__body-block-me-right-round")
                  div(class="final__body-block-me-right-round-txt") идем!
                  img(src="/assets/img/final/go.png" class="final__body-block-me-right-round-img")


          div(class="final__body-block-arrows")
            div(class="final__body-block-arrows-item top" v-on:click="changeVisTicket(true)")
              div(class="final__body-block-arrows-item-txt" v-if="activeMe") Билет друга
              img(src="/assets/img/final/arrow-top.svg" class="final__body-block-arrows-item-img")
            div(class="final__body-block-arrows-item bot" v-on:click="changeVisTicket(false)")
              img(src="/assets/img/final/arrow-bot.svg" class="final__body-block-arrows-item-img")
              div(class="final__body-block-arrows-item-txt" v-if="!activeMe") Ваш билет
      div(class="final__body-rules") 
        div(class="final__body-rules-rule" v-html="toResult.rules" v-on:click="showRules") 
        div(class="final__body-rules-socs" :class="{'active' : activeMe}")
          a(:href="`https://vk.com/share.php?&url=${link}=1`" target="_blank" @click="socSher(true)" class="final__body-rules-socs-link")
              img(src="/assets/img/final/vk-soc.svg" class="final__body-rules-socs-link-img")
          a(:href="`https://www.facebook.com/sharer/sharer.php?u=${link}`" target="_blank" @click="socSher(true)" class="final__body-rules-socs-link")
            img(src="/assets/img/final/fb-soc.svg" class="final__body-rules-socs-link-img")
      vue-page-transition(name="fade-in-bottom")
        div(ref="ruleBlock" class="final__rule" v-if="showRule")
          div(class="final__rule-txt") Воспользоваться промокодом может любой пользователь, который ранее не совершал покупок и не участвовал в любых других акциях сервиса Okko. Активируйте промокод на code.okko.tv и получите доступ на 30 дней за 1₽ к пакету подписок «Оптимум», а также 50% скидку на первое продление. Срок действия акции: 1.05.20-31.05.20. В день окончания 30-дневного периода за использование подписки «Оптимум» будет списана абонентская плата. Подробнее: <a href="https://okko.tv/s/friends" target="_blank">https://okko.tv/s/friends</a>
          img(src="/assets/img/final/x.svg" class="final__rule-close" @click="showRule = false")    
</template>

<script>

export default {
    data(){
      return {
         activeFriend: true,
         activeMe: false,
         showRule: false,
         params: {},
         promocode: '712557',
         ticketData: [
           {id: '1', txt: 'Билет для второй половинки:'},
           {id: '2', txt: 'Билет для друга:'},
           {id: '3', txt: 'Билет для члена семьи:'}
         ],
         finalData: [
              { 
                id: '1',
                title: 'Ура, билеты в кино <br class="mob">готовы! <br>Внутри —<br class="mob">промокод',
                desc: 'С ним вы получите доступ к 25 000 фильмов и сериалов <span>онлайн</span> на 30 дней',
                myTicket: 'Знатоку кино:',
                friendTicket: 'Настоящему киноману:',
                shareText: 'Пойдем в кино вместе?',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также смотрите любимые фильмы и сериалы в подборках на okko.tv Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '2',
                title: 'Ура, абонементы в фитнес <br>готовы! Внутри — промокод',
                desc: 'Смотрите тренировки для любого уровня подготовки, выставки, фильмы и концерты 30 дней',
                myTicket: 'Поклоннику спорта:',
                round: true,
                friendTicket: 'Обладателю идеальной фигуры:',
                shareText: 'Пойдем на фитнес вместе?',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также занимайтесь онлайн-тренировками в подборке «Фитнес против вируса». Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '3',
                title: 'Ура, билеты на концерт готовы! <br>Внутри — промокод',
                desc: 'Смотрите концерты в прямом эфире и в записи, выставки, фильмы и тренировки 30 дней',
                myTicket: 'Музыканту в душе:',
                friendTicket: 'Истинному меломану:',
                shareText: 'Пойдем на концерт вместе?',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также посещайте онлайн-концерты в подборке «ШоуOn» Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '4',
                title: 'Ура, билеты на выставку готовы! <br>Внутри — промокод',
                desc: 'Смотрите выставки и спектакли, тренировки, фильмы и концерты 30 дней',
                myTicket: 'Тонкому эстету:',
                friendTicket: 'Ценителю прекрасного:',
                shareText: 'Пойдем на выставку вместе?',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также ходите на онлайн-экскурсии с помощью подборки «Искусство онлайн». Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '5',
                title: 'Ура, билеты в путешествие <br>готовы! Внутри — промокод',
                desc: 'Смотрите экскурсии по разным странам, тренировки, фильмы и концерты 30 дней',
                myTicket: 'Любителю приключений:',
                round: true,
                friendTicket: 'Человеку без границ:',
                shareText: 'Отправимся в путешествие вместе?',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также путешествуйте онлайн с фильмами из бесплатной подборки «Без границ». Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
          ]
      }
    }, 
    methods: {    
              changeVisTicket(e){
                let meta = 'your_ticket'
                if(e) {
                  this.activeFriend = true
                  this.activeMe = false
                  meta = 'friend_ticket'
                } else {
                  this.activeFriend = false
                  this.activeMe = true
                }

                ga('send', {
                  hitType: 'event',
                  eventCategory: 'Quiz_May_2020',
                  eventAction: meta,  
                  eventLabel: '{{pageHostname}}{{pagePath}}' // URL страницы без строки запроса (?...)
                });
                window.dataLayer = window.dataLayer || []
                  dataLayer.push({
                    event: 'quiz_may_2020',
                    details: {
                      step: meta
                    }
                })

              },
              copyPromo(){
                let x = document.createElement("INPUT")
                x.setAttribute("type", "text");
                x.setAttribute("value", this.$refs.promo.innerHTML);
                document.body.appendChild(x);
                document.querySelector('INPUT').select();
                document.execCommand('copy');
                document.querySelector("INPUT").style.display="none";

                ga('send', {
                  hitType: 'event',
                  eventCategory: 'Quiz_May_2020',
                  eventAction: 'accept',  
                  eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
                });
                window.dataLayer = window.dataLayer || []
                  dataLayer.push({
                    event: 'quiz_may_2020',
                    details: {
                      step: 'accept'
                    }
                })


                if(window.innerWidth > 920){
                    this.$refs.ticketCheck.classList.add("end")
                    setTimeout(() => {
                      window.open(`https://bit.ly/3fsGecf`, '_blank')
                    }, 1000)   
                } else {
                    window.open(`https://bit.ly/3fsGecf`, '_blank')
                }
                
                
                             
              },
              showRules() {
                
                if(!this.showRule) {                  
                    this.showRule = true                    
                }                
              },              
              socSher(e){
                let ssss = 'share_purple'
                if(e) ssss = 'share_yellow'

                ga('send', {
                  hitType: 'event',
                  eventCategory: 'Quiz_May_2020',
                  eventAction: ssss,  
                  eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
                });
                window.dataLayer = window.dataLayer || []
                  dataLayer.push({
                    event: 'quiz_may_2020',
                    details: {
                      step: ssss
                    }
                })

              }
    },
    beforeMount(){ 
          this.params = window
          .location
          .search
          .replace('?','')
          .split('&')
          .reduce(
              function(p,e){
                  var a = e.split('=');
                  p[ decodeURI(a[0])] = decodeURI(a[1]);
                  return p;
              },
              {}
          );
    },
    computed: {        
        toResult() {       
            return this.finalData.find(e => e.id == this.params.where) || this.finalData[0]
        },
        toTicket() {          
          return this.ticketData.find(e => e.id == this.params.with) || this.ticketData[0]
        },
        toUrl(){
          return window.location.protocol + window.location.hostname
        },
        link(){
          return window.location.protocol + "//" + window.location.hostname + '/' + `result${this.params.where}=${encodeURIComponent(this.params.myName.replace(/ /g, '@'))}=${this.promocode}` + ' '
        },
        toShareUri(){
          return encodeURI(`${this.toResult.shareText} Смотри фильмы, концерты, онлайн-экскурсии 30 дней за 1₽, если не было подписки и покупок. Активируй свой промокод: ${window.location.protocol}//${window.location.hostname}/forMyfriend?where=${this.params.where}~${decodeURI(this.params.friendName)}`)
        },
        toImgVk(){
          return encodeURI(window.location.protocol + "//" + window.location.hostname + "/" + decodeURI(`result_img_${this.params.where}=${this.params.myName.replace(' ', '@')}=${this.promocode}=1.jpg`))
        }
    },
    mounted(){
        document.getElementById('transition').style.height = 'auto'
        setTimeout(() => {
                    window.scrollTo({
                      top: 0,
                      left: 0,
                      behavior: 'smooth'
                    })
                  
                }, 150)

                console.log(this.link)
    }
}
 </script>