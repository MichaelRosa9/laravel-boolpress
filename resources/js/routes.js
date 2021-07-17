import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Contact from './pages/Contact.vue';
import Blog from './pages/Blog.vue';
import PostDetail from './pages/PostDetail.vue';
import Error404 from './pages/Error404.vue';

const router = new VueRouter({
  mode: 'history', /* this enables the site to have a history of the routes, even if the page isn't technically reloading a new page but simply changing components */

  linkExactActiveClass:'active', /* 'linkExactActiveClass' is a class given to the router-links in order to add CSS styles to show the active page/route to your link. writing this line, I change it's default name to 'active' in this case so i can use Bootstrapp CSS class */
  
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
    {
      path: '/blog',
      name: 'blog',
      component: Blog
    },
    {
      path: '/post/:slug', /* ':' is the synthax for when a variable is expected. In this case I need slug */
      name: 'postDetail',
      component: PostDetail
    },
    {/* the error route must be put always at the end of the array */
      path: '/*',
      component: Error404
    },
  ]
});

export default router; /* have to have this string in order to import it in app.js */