<template>
  <div class="col-md-8">
    <tweetbox />
    <tweetlist v-for="tweet in tweets"  :tweets="tweet" v-bind:key="tweet.id" />
  </div>
</template>

<script>
import tweetbox from './tweetbox.vue'
import tweetlist from './TweetList'

export default {
  name: 'App',
  components: {
    tweetbox,
    tweetlist
  },
  mounted() {
    this.getTweets();
    setInterval(this.getTweets,2000);

  },
  data() {
    return {
      tweets:Object
    }
  },
  methods:{
    getTweets(){
      axios.get('/api/v1/tweet/all')
        .then((response) => {
          if (response.data.status==1) {
            this.tweets = response.data.tweets;
          }else{

          }
        }, (error) => {
          console.log(error);
        });
      
    }
  }
};
</script>
