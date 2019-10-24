<template>
  <div class="card text-left mt-2">
      <div class="card-header">
        {{ tweets.user.name }}
        <p class="float-right">
          <time-ago :refresh="10" :long=true :datetime="tweets.created_at"></time-ago>
        </p>
      </div>
      <div class="card-body">
        <!-- <h5 class="card-title">Tweet</h5> -->
        <p class="card-text">{{ tweets.tweet }}</p>
      </div>
      <div class="card-footer text-muted">
        <span>Likes <like fillColor="#3574d4"/></span>
        <span>Comments <Comment fillColor="#3574d4"/></span>
      </div>
    </div>
</template>

<script>

import like from 'vue-material-design-icons/ThumbUp.vue';
import Comment from 'vue-material-design-icons/Comment.vue';
import TimeAgo from 'vue2-timeago'


export default {
  components: {
    like,
    Comment,
    TimeAgo
  },
  props: {
    tweets: Object
  },
  mounted() {
  },
  methods:{
  }
};
</script>
