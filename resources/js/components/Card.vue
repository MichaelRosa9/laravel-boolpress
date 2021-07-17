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
            <a href="#" class="btn btn-primary">post.show</a>
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

<style>

</style>