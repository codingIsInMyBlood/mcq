<!DOCTYPE html>
<html>
<head>
	<title>Student Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
	<div class="container" id="app">
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Score</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="l in results">
					<td>@{{ l.student.id }}</td>
					<td>@{{ l.student.name }}</td>
					<td>@{{ l.result }}</td>
					<td>
						<span v-if="l.status == 1">Completed</span>
						<span v-else-if="l.status == 0">Incomplete</span>
						<span v-else-if="l.status == -1">Cancelled</span>
						<span v-else>N/A</span>
					</td>
				</tr>
			</tbody>
		</table>
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
    			results : [],
    			$http : ""
    		},
    		mounted : function(){
    			this.$http = axios.create({
                  baseURL: '/api/'
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

                this.fetchResults();
    		},
    		methods : {
    			error : function(msg){
                    // handle error
                    alert(msg);
                    return false;
                },
    			fetchResults : function(){
    				let ths = this;
                    this.$http.get("student/results")
                    .then(function(res){
                        if(res.error)
                            return ths.error(res.error);
                        ths.results = res.results;
                    });
    			}
    		}
    	});
    </script>
</body>
</html>