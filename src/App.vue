<template lang="pug">
  section(id="app" class="app")  
    vue-page-transition(name="fade-in-left" id="transition" class="app__transition")
      router-view

</template>

<script>
//import TopContext from './components/TopContext.vue'

export default {
  name: 'app',  
  mounted(){
        document.getElementById('loader').style.display = 'none'
        document.getElementById('app').style.display = 'block'
  }
  // beforeMount(){
  //   let gets = window
  //         .location
  //         .pathname
  //         .split('=')
          

  //       if(gets[0].indexOf('result') >=0) {
  //         let num = gets[0].substr(gets[0].indexOf('result')+6,1)
  //         let link = 'https://okko.tv/s/kino'
  //         switch(num) {
  //           case 1:
  //             link = 'https://okko.tv/s/kino'
  //           break;
  //           case 2:
  //             link = 'https://okko.tv/s/fitness'
  //           break;
  //           case 3:
  //             link = 'https://okko.tv/s/shows'
  //           break;
  //           case 4:
  //             link = 'https://okko.tv/s/arts'
  //           break;
  //           case 5:
  //             link = 'https://okko.tv/s/travel'
  //           break;
  //         }

  //         document.location.href = link;
  //       }
  // }
}
</script>