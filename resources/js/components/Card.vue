<template>
  <div>
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">{{ title }}</h5>
              <span class="badge badge-success custom-badge">{{ category }}</span>

            </div>
            <i>{{ date }}</i>
            <p class="card-text">
              {{ truncateText }} <!-- it's a computed function so it doesn't need brackets to be called  -->
            </p>
            <router-link class="btn btn-primary" :to="{name: 'postDetail', params:{ slug }}">Show Post</router-link> <!-- in 'params:{slug}' I'm abbreviating: 'params:{slug:slug}' -->
          </div>
        </div>
</template>

<script>
export default {
  name: 'Card',
  props: ['title', 'category', 'date', 'content', 'slug'],
  data(){
    return{
      maxLengthText: 150
    }
  },
  computed: {
    truncateText(){
      let text = this.content;
      if(text.length > this.maxLengthText){
        text = text.substr(0, this.maxLengthText) + '...';
      }
      return text;
    }
  },
}
</script>

<style lang="scss" scoped>
@import '../../sass/frontoffice/utilities.scss';

</style>