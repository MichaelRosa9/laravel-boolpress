<template>
  <div>
    <h1>Blog Vue</h1>
    <div>
      <main class="container">
        <h1>I nostri post</h1>

        <Loader v-if="loading" />

        <div v-else>
          <!-- post list -->
          <Card 
            v-for="post in posts" :key="'p' + post.id" class="card"
            :title="post.title"
            :category="post.category"
            :cover="post.cover"
            :date="FormatDate.format(post.date)"
            :slug="post.slug"
            :content="post.content"
          />
        </div>        

        <!-- pagination --> 
        <nav v-if="!loading"
          aria-label="Page navigation example"
        >
          <ul class="pagination">
            <li class="page-item"
              :class="{ 'disabled': pagination.current === 1}"
            >
              <button
                @click="getPostsAPI(pagination.current - 1)"
                class="page-link"
              >
                &laquo;
              </button>
            </li>

            <li class="page-item"
              v-for="i in pagination.last" :key="'i' + i"
              :class="{'active': pagination.current === i}"
            >
            <button class="page-link"
              @click="getPostsAPI(i)"
            >{{ i }}</button>
            </li>

            <li class="page-item"
              :class="{ 'disabled': pagination.current === pagination.last}"
            >
              <button
                @click="getPostsAPI(pagination.current + 1)"
                class="page-link"
              >
                &raquo;
              </button>
            </li>
          </ul>
        </nav>
        <!-- end pagination -->
      </main>
    </div>
  </div>
</template>

<script>
import Loader from '../components/Loader.vue';
import Card from '../components/Card.vue';
import FormatDate from '../classes/FormatDate';
import axios from "axios";

export default {
  name: "Blog",
  components: {
      Loader,
      Card
  },
  data() {
    return {
      posts: [],
      pagination: {},
      loading: true,
      FormatDate
    };
  },
  methods: {
    getPostsAPI(page = 1 /* in case of no param for page, page = 1*/) {
      axios.get("http://127.0.0.1:8000/api/posts", {
          params: {
            page: page,
          },
        })
        .then((res) => {
          this.posts = res.data.data;
          this.pagination = {
            current: res.data.current_page,
            last: res.data.last_page,
          };
          this.loading = false;
        })
        .catch((error) => {
          // handle error
          console.log(error);
        });
    },
  },
  created() {
    this.getPostsAPI();
  },
};
</script>

<style lang="scss" scoped>

</style>