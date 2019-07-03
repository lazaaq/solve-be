@extends('layouts.app')
@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class=""></i> <span class="text-semibold">Quiz Type</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-component">
        <ul class="breadcrumb">
            <li><a href="{{url('admin/dashboard')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="">Master Data</a></li>
            <li class="active">Quiz Type</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">
  <!-- State saving -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">State saving</h5>
			<div class="heading-elements">
				<ul class="icons-list">
      		<li><a data-action="collapse"></a></li>
      		<li><a data-action="reload"></a></li>
      		<li><a data-action="close"></a></li>
      	</ul>
    	</div>
		</div>

		<div class="panel-body">
			DataTables has the option of being able to <code>save the state</code> of a table: its paging position, ordering state etc., so that is can be restored when the user reloads a page, or comes back to the page after visiting a sub-page. This state saving ability is enabled by the <code>stateSave</code> option. The <code>duration</code> for which the saved state is valid can be set using the <code>stateDuration</code> initialisation parameter (2 hours by default).
		</div>

		<table class="table datatable-save-state">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Picture</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Marth</td>
					<td><a href="#">Enright</a></td>
					<td>Traffic Court Referee</td>
					<td>22 Jun 1972</td>
					<td><span class="label label-success">Active</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Jackelyn</td>
					<td>Weible</td>
					<td><a href="#">Airline Transport Pilot</a></td>
					<td>3 Oct 1981</td>
					<td><span class="label label-default">Inactive</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Aura</td>
					<td>Hard</td>
					<td>Business Services Sales Representative</td>
					<td>19 Apr 1969</td>
					<td><span class="label label-danger">Suspended</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Nathalie</td>
					<td><a href="#">Pretty</a></td>
					<td>Drywall Stripper</td>
					<td>13 Dec 1977</td>
					<td><span class="label label-info">Pending</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Sharan</td>
					<td>Leland</td>
					<td>Aviation Tactical Readiness Officer</td>
					<td>30 Dec 1991</td>
					<td><span class="label label-default">Inactive</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Maxine</td>
					<td><a href="#">Woldt</a></td>
					<td><a href="#">Business Services Sales Representative</a></td>
					<td>17 Oct 1987</td>
					<td><span class="label label-info">Pending</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Sylvia</td>
					<td><a href="#">Mcgaughy</a></td>
					<td>Hemodialysis Technician</td>
					<td>11 Nov 1983</td>
					<td><span class="label label-danger">Suspended</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Lizzee</td>
					<td><a href="#">Goodlow</a></td>
					<td>Technical Services Librarian</td>
					<td>1 Nov 1961</td>
					<td><span class="label label-danger">Suspended</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Kennedy</td>
					<td>Haley</td>
					<td>Senior Marketing Designer</td>
					<td>18 Dec 1960</td>
					<td><span class="label label-success">Active</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Chantal</td>
					<td><a href="#">Nailor</a></td>
					<td>Technical Services Librarian</td>
					<td>10 Jan 1980</td>
					<td><span class="label label-default">Inactive</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Delma</td>
					<td>Bonds</td>
					<td>Lead Brand Manager</td>
					<td>21 Dec 1968</td>
					<td><span class="label label-info">Pending</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Roland</td>
					<td>Salmos</td>
					<td><a href="#">Senior Program Developer</a></td>
					<td>5 Jun 1986</td>
					<td><span class="label label-default">Inactive</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Coy</td>
					<td>Wollard</td>
					<td>Customer Service Operator</td>
					<td>12 Oct 1982</td>
					<td><span class="label label-success">Active</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Maxwell</td>
					<td>Maben</td>
					<td>Regional Representative</td>
					<td>25 Feb 1988</td>
					<td><span class="label label-danger">Suspended</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td>Cicely</td>
					<td>Sigler</td>
					<td><a href="#">Senior Research Officer</a></td>
					<td>15 Mar 1960</td>
					<td><span class="label label-info">Pending</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- /state saving -->
</div>
<!-- /content area -->
@endsection
