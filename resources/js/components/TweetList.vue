<template>
  <div class="card text-left mt-2">
      <div class="card-header">
        <img v-bind:src="tweets.user.avatar_url" height="40" v-bind:style="avatar_img">
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
        <span @click="doLike(tweets.id)" >{{ (tweets.likes) ? tweets.likes.total_like : 0 }} <like fillColor="#3490dc"/></span>
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
    tweets: Object,
    is_liked:'background-color:blue;',
    is_not_liked:''
  },
  data(){
    return{
      avatar_img:'border-radius: 10px;margin-right: 8px;'
    }
  },
  mounted() {
  },
  methods:{
    doLike(tweet_id) {
      this.axios
      .post("api/v1/tweet/like", {
        user_id: $("#uid").val(),
        tweet_id: tweet_id
      })
      .then(function(response) {
        alert(response.data.status);
      })
      .catch(function(error) {
      });
    }
  }
};
</script>
