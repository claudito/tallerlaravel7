@extends('layouts.app')

@section('title')
Empleados
@endsection

@section('content')






<div class="container-fluid">

	<div class="row">


		<div class="col-md-12">

			<button type="button" class="btn btn-primary btn-agregar"><i class="fa fa-plus"></i> Agregar</button>

			<br><br>
			
	
				<div class="table-responsive-md">
					

					<table class="table"  id="consulta">

						<thead>
							
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start Date</th>
								<th>Salary</th>
								<th>Acciones</th>
							</tr>


						</thead>
						

					</table>


				</div>


		</div>
	

	</div>
 

</div>


 <!-- Modal Agregar -->
	<form id="agregar" autocomplete="off">
		

		<div class="modal fade" id="modal-agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		  <div class="modal-dialog">
		    <div class="modal-content">

		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <div class="modal-body">


		      	@csrf
		     
				<div class="form-group">
					<label >Name</label>
					<input type="text" name="name" class="form-control" required>
				</div>

				<div class="form-group">
					<label >Position</label>
					<input type="text" name="position" class="form-control" required>
				</div>

				<div class="form-group">
					<label >Office</label>
					<input type="text" name="office" class="form-control" required>
				</div>


				<div class="form-group">
					<label >Age</label>
					<input type="number" name="age" class="form-control" required min="18" max="80">
				</div>

				<div class="form-group">
					<label >Start Date</label>
					<input type="date" name="start_date" class="form-control" required>
				</div>

				<div class="form-group">
					<label >Salary</label>
					<input type="number" name="salary" class="form-control" required step="any" min="0">
				</div>




		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		        <button type="submit" class="btn btn-primary">Agregar</button>
		      </div>

		    </div>
		  </div>

		</div>


	</form>




<script>
	
	//Función Cargar Data
	function loadData(){

		$(document).ready(function(){


			$('#consulta').DataTable({

				destroy:true,
				ajax:{

					url:'{{ route('empleados.index') }}',
					type:'GET'

				},
				columns:[

					{data:'name'},
					{data:'position'},
					{data:'office'},
					{data:'age'},
					{data:'start_date'},
					{data:'salary'},
					{data:null,render:function(data){


						return ` 


							<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>


							<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>




						`;



					}}


				]


			});



		});


	}


	loadData();


	//Cargar Modal Agregar
	$(document).on('click','.btn-agregar',function(){

		$('#agregar')[0].reset();
		$('.modal-title').html('Agregar');
		$('#modal-agregar').modal('show');



	});


	//Agregar
	$(document).on('submit','#agregar',function(e){

		parametros = $(this).serialize();

		$.ajax({

			url:'{{ route('empleados.store') }}',
			type:'POST',
			data:parametros,
			dataType:'JSON',
			beforeSend:function(){


				Swal.fire({

					title :'Cargando',
					text  :'Espere un momento...',
					showConfirmButton:false

				});


			},
			success:function(data){


				loadData();
				$('#modal-agregar').modal('hide');

				Swal.fire({

					title : data.title,
					text  : data.text,
					icon  : data.icon,
					timer : 3000,
					showConfirmButton:false



				});


			}
			



		});

		e.preventDefault();
	});


</script>
@endsection
