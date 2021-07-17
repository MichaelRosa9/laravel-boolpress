<template>
  <div>
    <h1>Blog Vue</h1>
    <div>
      <main class="container">
        <h1>I nostri post</h1>

        <div v-for="post in posts" :key="'p' + post.id" class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">{{ post.title }}</h5>
              <span class="badge badge-success custom-badge">{{ post.category }}</span>

            </div>
            <i>{{ formatDate(post.date) }}</i>
            <p class="card-text">
              {{ post.content }}
            </p>
            <a href="#" class="btn btn-primary">post.show</a>
          </div>
        </div>
        <article class="mb-2"></article>

        <!-- <div class="nav-pages">
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
        </div> -->
      <nav aria-label="Page navigation example">
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
      </main>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Blog",
  data() {
    return {
      posts: [],
      pagination: {},
    };
  },
  methods: {
    getPostsAPI(page = 1 /* in case of no param for page, page = 1*/) {
      axios
        .get("http://127.0.0.1:8000/api/posts", {
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
        })
        .catch((error) => {
          // handle error
          console.log(error);
        });
    },
    formatDate(date) {
      let d = new Date(date);
      let dy = d.getDate();
      let m = d.getMonth() + 1;
      let y = d.getYear();

      if (dy < 10) dy = "0" + dy;
      if (m < 10) m = "0" + m;

      return `${dy}/${m}/${y}`;
    },
  },
  created() {
    this.getPostsAPI();
  },
};
</script>

<style lang="scss" scoped>
.custom-badge {
  display: inline-block;
  height: 2rem;
  line-height: 2rem;
}
</style>