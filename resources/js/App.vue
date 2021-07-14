<template>
  <div>
    <Header />
    <main class="container">
      <h1>I nostri post</h1>

      <article
        class="mb-2"
        v-for="post in posts" :key="post.id"
      >
      <h3>{{ post.title }}</h3>
      <h6>{{ post.category }}</h6>
      <h5>{{ formatDate(post.date) }}</h5>
      <div><a href="#">vai...</a></div>
    </article>
    
    <div class="nav-pages">
      <button 
        v-if="pagination.current > 1"
        @click="getPostsAPI(pagination.current - 1)"
        class="badge badge-primary"
        >
          prev
        </button>
      <button 
        v-if="pagination.current < pagination.last"
        @click="getPostsAPI(pagination.current + 1)"
        class="badge badge-primary"
        >
          next
        </button>
    </div>
    </main>
    
  </div>
</template>

<script>

import Header from './components/Header.vue';
import axios from 'axios';
export default {
    name: 'App',
    components: {
      Header
    },
    data(){
      return {
        posts: [],
        pagination: {}
      }
    },
    methods:{
      getPostsAPI(page = 1/* in case of no param for page, page = 1*/){
        axios.get('http://127.0.0.1:8000/api/posts',{
          params: {
            page: page
          }
        })
        .then(res => {          
          this.posts = res.data.data;
          this.pagination = {
            current: res.data.current_page,
            last: res.data.last_page
          }
        })
        .catch(error => {
          // handle error
          console.log(error);
        })
      },
      formatDate(date){
        let d = new Date(date);
        let dy = d.getDate();
        let m = d.getMonth() + 1;
        let y = d.getYear();

        if(dy < 10) dy = '0' + dy; 
        if(m < 10) m = '0' + m; 

        console.log(d);        
         return `${dy}/${m}/${y}`;
         return d
      }
    
    },
    created(){
      this.getPostsAPI()
    }
}
</script>

<style lang="scss">

  @import '../sass/frontoffice/global.scss';

</style>