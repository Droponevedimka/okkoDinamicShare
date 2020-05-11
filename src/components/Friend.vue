<template lang="pug">
    section(class="friend")        
      div(class="friend__top")
        div(class="friend__top-block")
          div(class="friend__top-block-title" v-html="toResult.title")
          a(href="https://okko.tv/?utm_source=quiz&utm_medium=refferal&utm_campaign=kinoafisha" class="friend__top-block-logo" target="blank")
            img(src="/assets/img/logo.svg" class="friend__top-block-logo-img")
        div(class="friend__top-desc" v-html="toResult.desc")

      div(class="friend__body")
        
        div(class="friend__body-block")
          div(class="friend__body-block-who")

            div(class="friend__body-block-friend" :class="{'round' : toResult.round}")              
              img(:src="`/assets/img/friend/ticket-friend-mob-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="friend__body-block-friend-mob")
              div(class="friend__body-block-friend-left" :class="{'round' : toResult.round}")
                img(:src="`/assets/img/friend/ticket-friend-left-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="friend__body-block-friend-left-desc" )
                div(class="friend__body-block-friend-left-block")
                  div(class="friend__body-block-title" v-html="toResult.friendTicket")
                  div(class="friend__body-block-name") {{params[1]}}
                  div(class="friend__body-block-option")
                    div(class="friend__body-block-option-left") Место:
                    div(class="friend__body-block-option-right") онлайн-кинотеатр Okko
                  div(class="friend__body-block-option")
                    div(class="friend__body-block-option-left") Время:
                    div(class="friend__body-block-option-right") когда удобно ☺️
                  div(class="friend__body-block-option desk")
                    div(class="friend__body-block-option-left") Ваш промокод:
                    div(ref="promo" id="promo" class="friend__body-block-option-right promocode") {{promocode}}
                  div(class="friend__body-block-option mob margin")
                    div(class="friend__body-block-option-right") Мой промокод: <span class="promo">{{promocode}}</span>
              div(ref="ticketCheck" class="friend__body-block-friend-right" :class="{'round' : toResult.round}")
                img(:src="`/assets/img/friend/ticket-friend-right-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.png`" class="friend__body-block-friend-right-desc" )
                div( v-on:click="copyPromo()" class="friend__body-block-friend-right-round")
                  div(class="friend__body-block-friend-right-round-txt") идем!
                  img(src="/assets/img/friend/go.png" class="friend__body-block-friend-right-round-img")

      div(class="friend__body-rules") 
        img(class="friend__body-rules-img-mob" :class="{'full' : toResult.mobWidth, 'palm' : toResult.palm}" :src="`/assets/img/friend/friend-mob-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.svg`")
        router-link(to="/" class="friend__body-rules-btn" v-on:click="inviteFrnd") ПРИГЛАШУ ЕЩЕ ДРУГА
        div(class="friend__body-rules-rule" v-html="toResult.rules" v-on:click="showRules") 
        img(class="friend__body-rules-img" :src="`/assets/img/friend/friend-${toResult.id > 0 && toResult.id < 6 ? toResult.id : 1}.svg`")
        
      vue-page-transition(name="fade-in-bottom")
        div(ref="ruleBlock" class="friend__rule" v-if="showRule")
          div(class="friend__rule-txt") Воспользоваться промокодом может любой пользователь, который ранее не совершал покупок и не участвовал в любых других акциях сервиса Okko. Активируйте промокод на code.okko.tv и получите 50% скидку на первое продление. Срок действия акции: 1.05.20-31.05.20. В день окончания 30-дневного периода за использование подписки «Оптимум» будет списана абонентская плата. Подробнее: <a href="https://okko.tv/s/friends" target="_blank">https://okko.tv/s/friends</a>
          img(src="/assets/img/friend/x.svg" class="friend__rule-close" @click="showRule = false")  
         
</template>

<script>

export default {
    data(){
      return {
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
                title: 'Пойдем в кино?',
                desc: 'Дарю именной билет — с ним ты получишь доступ <br>к 25 000* фильмов и сериалов <span>онлайн</span> на 30 дней ☺',
                friendTicket: 'Настоящему киноману:',
                shareText: 'Пойдем в кино вместе?',
                toLink: 'https://okko.tv/s/kino',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также смотрите любимые фильмы и сериалы в подборках на okko.tv Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '2',
                title: 'Пойдем на фитнес?',
                desc: 'Дарю именной абонемент — внутри <br>промокод на 25 000 фильмов и сериалов ☺',
                round: true,
                friendTicket: 'Обладателю идеальной фигуры:',
                shareText: 'Пойдем на фитнес вместе?',
                toLink: 'https://okko.tv/s/fitness',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также занимайтесь онлайн-тренировками в подборке «Фитнес против вируса». Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '3',
                title: 'Пойдем на концерт?',
                desc: 'Дарю именной билет — с ним ты получишь доступ <br>к 25 000* фильмов и сериалов <span>онлайн</span> на 30 дней ☺',
                friendTicket: 'Искушенному меломану:',
                shareText: 'Пойдем на концерт вместе?',
                toLink: 'https://okko.tv/s/shows',
                mobWidth: true,
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также посещайте онлайн-концерты в подборке «ШоуOn» Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '4',
                title: 'Пойдем на выставку ?',
                desc: 'Дарю именной билет — с ним ты получишь доступ <br>к 25 000* фильмов и сериалов <span>онлайн</span> на 30 дней ☺',
                friendTicket: 'Ценителю прекрасного:',
                shareText: 'Пойдем на выставку вместе?',
                toLink: 'https://okko.tv/s/arts',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также ходите на онлайн-экскурсии с помощью подборки «Искусство онлайн». Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
              { 
                id: '5',
                title: 'Отправимся в путешествие ?',
                desc: 'Дарю именной билет — с ним ты получишь доступ <br>к 25 000* фильмов и сериалов <span>онлайн</span> на 30 дней ☺',
                round: true,
                friendTicket: 'Человеку без границ:',
                palm: true,
                shareText: 'Отправимся в путешествие вместе?',
                toLink: 'https://okko.tv/s/travel',
                rules: 'Билет дает доступ к подписке «Оптимум» на 30 дней за 1 рубль новому пользователю. Смотрите 25 000 фильмов и сериалов в подписке «Оптимум», а также путешествуйте онлайн с фильмами из бесплатной подборки «Без границ». Полные правила акции для новых пользователей ищите <span>здесь</span>'
              },
          ]
      }
    }, 
    methods: {   
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
                      window.open(`${this.toResult.toLink}`, '_blank')
                    }, 1000)   
                } else {
                    window.open(`${this.toResult.toLink}`, '_blank')
                }
                
                
                             
              },
              inviteFrnd(){
                  ga('send', {
                    hitType: 'event',
                    eventCategory: 'Quiz_May_2020',
                    eventAction: 'invite_friend',  
                    eventLabel: `${window.location.hostname}${window.location.pathname}` // URL страницы без строки запроса (?...)
                  });
                  window.dataLayer = window.dataLayer || []
                    dataLayer.push({
                      event: 'quiz_may_2020',
                      details: {
                        step: 'invite_friend'
                      }
                  })
              },
              showRules() {
                
                if(!this.showRule) {                  
                    this.showRule = true                    
                }                
              }              
    },
    beforeMount(){ 
          let date = window
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
          console.log(date)
          this.params = date.where.split('~')
    },
    computed: {        
        toResult() {       
            return this.finalData.find(e => e.id == this.params[0]) || this.finalData[0]
        },        
        toUrl(){
          return window.location.protocol + window.location.hostname
        },
        link(){
          return encodeURI(window.location.protocol + "//" + window.location.hostname + "/" + decodeURI(`result${this.params.where}=${this.params.myName}=${this.promocode}`))
        },
        toImgVk(){
          return encodeURI(window.location.protocol + "//" + window.location.hostname + "/" + decodeURI(`result_img_${this.params.where}=${this.params.myName}=${this.promocode}=1.jpg`))
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
    }
}
 </script>