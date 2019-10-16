<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">What's going on?</div>
          <div class="alert alert-info sr-only" id="output">{{output}}</div>
          <div class="card-body">
            <form @submit="formSubmit">
              <div class="form-group">
                <textarea
                  v-model="tweet"
                  class="form-control"
                  id="exampleInputEmail1"
                  placeholder="Write here"
                  rows="5"
                ></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" type="submit" id="tweet_btn">Tweet</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      tweet: "",
      output: ""
    };
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      $("#tweet_btn").html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>Tweet</span>'
      );
      this.axios
        .post("api/v1/tweet/create", {
          tweet: this.tweet,
          user_id: $("#user_id").attr("content")
        })
        .then(function(response) {
          $("#output").removeClass("sr-only");
          currentObj.output = response.data.message;
          $("#tweet_btn").html("Tweet");
        })
        .catch(function(error) {
          currentObj.output = error;
        });
    }
  }
};
</script>
