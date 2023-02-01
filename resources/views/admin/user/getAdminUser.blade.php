
<div class="table-responsive">
	<table id="myTable" class="table">
	  <thead>
	    <tr>
	      <th scope="col">Photo</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Operation</th>
	    </tr>
	  </thead>
	  <tbody>
          @forelse ($users as $user)
          <tr>
            <td scope="row">
                <span class="user-icon">
                    <img class="mCS_img_loaded" src="{{ asset("assets/vendors/images/avatar/" . $user -> avatar ) }}">
                </span>
            </td>
            <td scope="row">{{ $user -> name }}</td>
            <td scope="row">{{ $user -> email }}</td>
            <td scope="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                    <a href="{{ url("viewAdminUser" . $user -> id) }}" type="button" class="btn btn-outline-primary">View</a>
                    <a href="{{ url("editAdminUser" . $user -> id) }}" class="btn btn-outline-primary">Edit</a>
                    <button type="button" class="btn btn-outline-primary delUserBtn" data-id="{{ $user -> id }}">Delete</button>
                </div>
            </td>
          </tr>
          @empty
              <tr style="text-align: center">
                  <td colspan="4">There is no data to show</td>
              </tr>
          @endforelse
	  </tbody>
	</table>
</div>
			