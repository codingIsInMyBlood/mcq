<!DOCTYPE html>
<html>
<head>
    <title>MCQ</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <style type="text/css">
      [v-cloak]{
        display: none;
      }
  </style>
</head>
<body>
    <div id="app" class="container" style="padding-top: 10%;" v-cloak>
        <div v-if="loading">
            <h1>Please Wait...</h1>
        </div>
        <div v-else>
            <div class="card" v-if="askName">
               <div class="card-header">Please Enter Your Name</div> 
               <div class="card-body">
                    <input type="text" class="form-control" v-model="name" placeholder="Please enter your full name">
                </div>
                <div class="card-footer">
                    <div style="float: right;">
                        <button @click.prevent="start" class="btn btn-primary">Start</button>
                    </div>
                        
                </div>
            </div>

            <div class="card" v-else-if="showResult">
               <div class="card-header">Hi @{{name}}</div> 
               <div class="card-body">
                    <h2>Your score is @{{ score }}</h2>
                </div>
                <div class="card-footer">
                    <div style="float: right;">
                        <a href="/" class="btn btn-primary">Start New Exam</a>
                    </div>
                        
                </div>
            </div>

            <div class="card" v-else>
              <div class="card-header">@{{ question.position }}) @{{question.question}}</div>
              <div class="card-body">
                <div class="" v-for="option in options">
                  <input :value="option.id" type="radio" class="" name="example1" v-model="selectedAnswer">
                  <label class="" for="customRadio1">@{{option.option}}</label>
                </div>
              </div> 
              <div class="card-footer">
                <div style="float: right;">
                    <button @click.prevent="ansSubmit" class="btn btn-success">Submit</button>
                    <button @click.prevent="nextQuestion" class="btn btn-primary">Next</button>
                </div>
              </div>
            </div>
        </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
        new Vue({
            el : "#app",
            data : {
                loading : false,
                askName : true,
                question : {postion:"",question:"",id:""},
                options : [],
                name : "",
                questions : [],
                position : 0,
                selectedAnswer : "",
                showResult : false,
                $http : null,
                score : 0
            },
            mounted : function(){
                let ths = this;
                this.$http = axios.create({
                  baseURL: '/api/'
                });
                this.$http.interceptors.request.use(function (config) {
                    console.log(config);
                    config.headers.secret = ths.getSecret();
                    return config;
                  }, function (error) {
                    // Do something with request error
                    return Promise.reject(error);
                });

                this.$http.interceptors.response.use(function (response) {
                    let secret = "";
                    if(typeof response.headers.secret != "undefined")
                        secret = response.headers.secret;
                    localStorage.setItem("secret", secret);
                    return Promise.resolve(response.data);
                  }, function (error) {
                    // Do something with request error
                    return Promise.reject(error);
                });

                // refresh
                this.$http.get("refresh")
                

            },
            methods : {
                getSecret : function(){
                    let s = localStorage.getItem("secret");
                    if(s == null) return "";
                    return s;
                },
                error : function(msg){
                    // handle error
                    alert(msg);
                    return false;
                },
                start : function(){
                    let ths = this;
                    this.$http.post("student",{name:this.name})
                    .then(function(res){
                        if(res.error)
                            return ths.error(res.error);
                        ths.fetchQuestions();
                    });
                },
                fetchQuestions: function(){
                    let ths = this;
                    this.$http.get("mcq")
                    .then(function(res){
                        if(res.error)
                            return ths.error(res.error);
                        ths.questions = res.data;
                        ths.askName = false;
                        ths.nextQuestion();
                    });
                },
                nextQuestion : function(){
                    let index = this.position;
                    if(index > 9){
                        this.showResult = true;
                        this.fetchScore();
                        return false;
                    }
                    let q = this.questions[index];
                    this.question = {
                        question:q.question,
                        id:q.id,
                        position : index + 1
                    };
                    this.options = this.questions[index].options;
                    this.position++;
                    this.selectedAnswer = "";
                },
                ansSubmit : function(){
                    if(this.selectedAnswer == "")
                        return this.error("Please select answer");
                    let ths = this;
                    this.$http.post("mcq/check",{
                        optionId : this.selectedAnswer,
                        questionId : this.question.id
                    })
                    .then(function(res){
                        if(res.error)
                            ths.error(res.error);
                        ths.nextQuestion();
                    });
                },
                fetchScore : function(){
                    let ths = this;
                    this.$http.post("student/complete")
                    .then(function(res){
                        if(res.error)
                            ths.error(res.error);
                        ths.score = res.score;
                        localStorage.setItem("secret",""); // destroy
                    });
                }
            }
        });
    </script>
</body>
</html>