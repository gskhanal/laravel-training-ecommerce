<x-admin.layout>
  <div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <a href="{{ route('admin.categories.create') }}">Create Category</a>
        <table width="900" align="center">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Description</td>
                <td>Slug</td>
                <td>Action</td>
            </tr>
            @foreach ($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td> {{ $category->name }} </td>
                <td> {{ substr($category->description, 0, 50) }} </td>
                <td>{{ $category->slug }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}"> Edit </a> | <a href="#"> Delete </a>
                </td>
              </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>
</x-admin.layout>