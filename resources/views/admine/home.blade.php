@extends('admine.layout')

@section('main')

<div class="">
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher..." aria-label="Rechercher">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-filter"></i> Filtrer par Destinateur
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-filter"></i> Filtrer par Destinataire
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-filter"></i> Filtrer par Date
                </button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Objet</th>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Destinateur</th>
                    <th>Destinataire</th>
                    <th>Division</th>
                    <th>Fichier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Table rows with data will be dynamically populated here -->
                <tr>
                    <td>Objet 1</td>
                    <td>2023-01-01</td>
                    <td>Service A</td>
                    <td>Destinateur A</td>
                    <td>Destinataire A</td>
                    <td>Division A</td>
                    <td><a href="/path/to/file1.pdf">file1.pdf</a></td>
                    <td>
                        <button class="btn btn-sm btn-primary">Update</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Objet 2</td>
                    <td>2023-01-02</td>
                    <td>Service B</td>
                    <td>Destinateur B</td>
                    <td>Destinataire B</td>
                    <td>Division B</td>
                    <td><a href="/path/to/file2.pdf">file2.pdf</a></td>
                    <td>
                        <button class="btn btn-sm btn-primary">Update</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <!-- Additional rows go here -->
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">&raquo;</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

@endsection
