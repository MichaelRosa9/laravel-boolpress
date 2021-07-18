<template>
  <Loader v-if="loading" />
  <div v-else>
    <div class="card mb-3">
      <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">{{ post.title }}</h5>
              <span v-if="post.category" class="badge badge-success custom-badge">{{ post.category.name }}</span><!-- must use v-if in order to check if property is available or not because if there isn't and you don't have v-if it will give you an error in the console -->

            </div>
            <i>{{ FormatDate.format(post.created_at) }}</i>
            <p class="card-text">
              {{ post.content }}
            </p>
            <div>
              <i
                v-for="tag in post.tags" :key="'t'+ tag.id"
              >
              {{ tag.name }}
              </i>
            </div>
          </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios';
import Loader from '../components/Loader.vue';
import FormatDate from '../classes/FormatDate'; /* the class is recalled in the data */

export default {
  name: 'PostDetail',
  components:{
    Loader
  },
  data(){
    return {
      post: {},
      loading: true,
      FormatDate
    }
  },
  mounted(){
    /* $route is an object passed from the router that contains parameters passed by  */
    /* console.log(this.$route.params.slug); */
    axios.get('http://127.0.0.1:8000/api/posts/'+ this.$route.params.slug)
      .then(res => {
        
        if(res.data.success){
          this.post = res.data.data;
          this.loading = false;
        }else{
          //redirect to error404 page
          this.$router.push({name: 'error404'})
        }
      })
      .catch(err => {
        console.log(err);
      });
  }
}
</script>

<style lang="scss" scoped>

@import '../../sass/frontoffice/utilities.scss';
i {
  display: inline-block;
  margin-right: 10px;
}

</style>