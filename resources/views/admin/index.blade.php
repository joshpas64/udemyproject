@extends('layouts.admin')

@section('content')
	<h1 class="text-primary text-center">Administration Dashboard {{Auth::user() ? "for " . Auth::user()->name : ""}}</h1>
	<canvas id="myChart"></canvas>
@endsection

@section('scripts')
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
	    <script>
			var ctx = document.getElementById("myChart").getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: ["Posts", "Users", "Comments", "Replies", "Media"],
			        datasets: [{
			            label: 'Number of Entries',
			            data: [{{$postCount}}, {{$userCount}}, {{$commentCount}}, {{$replyCount}}, {{$photoCount}} ],
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255,99,132,1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)'
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
		</script>
@endsection