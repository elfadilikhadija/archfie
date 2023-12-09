@extends('cadre.layout')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-3">
                <form method="POST" action="{{ route('fichiers.search') }}" class="input-group">
                                        @csrf
                    <input type="text" class="form-control " name="query" placeholder="Rechercher..."
                        aria-label="Rechercher">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="btn-group" role="group">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-filter">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>Filtrer par Catégorie
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                            @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('fichiers.filteredByCategory', $category->id) }}">
                                    {{ $category->nom }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="dropdown mx-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="divisionDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-filter">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg>Filtrer par Division
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="divisionDropdown">
                            @foreach($divisions as $division)
                                <li><a class="dropdown-item" href="{{ route('fichiers.filteredByDivision', $division->id) }}">{{ $division->nom }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- hhh --}}
             <!-- Excel Filter Button -->
    <div class="col-md-3">
        <button class="btn btn-outline-secondary" onclick="filterByExtension('.xls, .xlsx')">
            Excel
        </button>
        <!-- CSV Filter Button -->
        <button class="btn btn-outline-secondary " onclick="filterByExtension('.csv')">
          CSV
        </button>
        <!-- PDF Filter Button -->
        <button class="btn btn-outline-secondary" onclick="filterByExtension('.pdf')">
          PDF
        </button>
    </div>
            {{-- kk --}}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Objet</th>
                        <th>Numero</th>
                        <th>Destinateur</th>
                        <th>Destinataire</th>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Division</th>
                        <th>Categorie</th>
                        <th>Fichier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fichiers as $fich)
                <tr>
                    <td>{{ $fich->id }}</td>
                    <td>{{ $fich->objet }}</td>
                    <td>{{ $fich->numero }}</td>
                    <td>{{ $fich->destinateurt }}</td>
                    <td>{{ $fich->destinataire }}</td>
                    <td>{{ $fich->date }}</td>
                    <td>{{ $fich->division->nom }}</td>
                    <td>{{ $fich->service->nom }}</td>
                    <td>{{ $fich->categorie->nom }}</td>
                    <td>
                        <a href="{{ asset('storage/pdfs/'.$fich->fichier) }}" target="_blank">View PDF</a>
                    </td>
                    <td>
                        <a href="{{ route('fichiers.edit', ['id' => $fich->id]) }}" class="btn btn-sm btn-primary">Update</a>
                        <form action="{{ route('fichiers.destroy', ['id' => $fich->id]) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
<!-- start  Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Modifier le fichier</h5>
                <button type="button" class="close bg-warning border-warning" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal Body (Your Form Goes Here) -->
           <div class="modal-body">
            @foreach($fichiers as $fichier)
    <form method="POST" class="border p-5" action="{{ route('fichiers.update', ['id' => $fichier->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="objet" class="form-label">Objet:</label>
                    <input type="text" class="form-control" id="objet" name="objet" value="{{ $fichier->objet }}" required>
                </div>

                <div class="mb-3">
                    <label for="numero" class="form-label">Numero:</label>
                    <input type="text" class="form-control" id="numero" name="numero" value="{{ $fichier->numero }}" required>
                </div>

                <div class="mb-3">
                    <label for="destinateurt" class="form-label">Destinateur:</label>
                    <input type="text" class="form-control" id="destinateurt" name="destinateurt" value="{{ $fichier->destinateurt }}" required>
                </div>

                <div class="mb-3">
                    <label for="destinataire" class="form-label">Destinataire:</label>
                    <input type="text" class="form-control" id="destinataire" name="destinataire" value="{{ $fichier->destinataire }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="date" class="form-label">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $fichier->date }}" required>
                </div>
                <div class="mb-3">
                    <label for="division_id" class="form-label">Division:</label>
                    <select class="form-select" id="division_id" name="division_id" required>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" @if($division->id === $fichier->division_id) selected @endif>{{ $division->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="service_id" class="form-label">service:</label>
                    <select class="form-select" id="service_id" name="service_id" required>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" @if($service->id === $fichier->service_id) selected @endif>{{ $division->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="categorie_id" class="form-label">Categorie:</label>
                    <select class="form-select" id="categorie_id" name="categorie_id" required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" @if($categorie->id === $fichier->categorie_id) selected @endif>{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier (PDF):</label>
                    <input type="file" class="form-control" id="fichier" name="fichier" accept=".pdf"> <!-- Update file input -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update Fichier</button>
            </div>
        </div>
    </form>
    @endforeach
</div>
        </div>
    </div>
</div>

{{-- end modal --}}
        {{-- code of pagination --}}
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">

        {{-- Previous Page Link --}}
        @if ($fichiers->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $fichiers->previousPageUrl() }}" aria-label="Previous">Previous</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @for ($i = 1; $i <= $fichiers->lastPage(); $i++)
            <li class="page-item{{ $i == $fichiers->currentPage() ? ' active' : '' }}">
                <a class="page-link" href="{{ $fichiers->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Next Page Link --}}
        @if ($fichiers->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $fichiers->nextPageUrl() }}" aria-label="Next">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true">Next</span>
            </li>
        @endif
    </ul>
</nav>
{{-- end of pagination --}}

<script>
  <script>
        function confirmDelete() {
            return confirm('Voulez-vous supprimer ce fichier ?');
        }
    </script>
</script>
     {{-- end script of delet button --}}
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function filterByExtension(extension) {
        // Get the file input element
        var fileInput = document.getElementById('fileInput');

        // Get the selected files
        var files = fileInput.files;

        // Filter files by extension
        var filteredFiles = Array.from(files).filter(file => {
            var fileName = file.name.toLowerCase();
            return fileName.endsWith(extension);
        });

        // Display the filtered files using SweetAlert
        Swal.fire({
            title: 'Filtered Files',
            html: 'Filtered Files: ' + filteredFiles.map(file => file.name).join('<br>'),
            icon: 'info'
            // You can customize the appearance and behavior of SweetAlert as needed
        });
    }
</script>
    </div>
@endsection
