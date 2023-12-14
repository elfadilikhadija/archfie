@extends('admine.layout')
@section('content')
    <h2 class="text-center">Créer un fichier</h2>
    <section class="signup-step-container">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"
                                        aria-expanded="true"><span class="round-tab">1 </span> <i>Step 1</i></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"
                                        aria-expanded="false"><span class="round-tab">2</span> <i>Step 2</i></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span
                                            class="round-tab">3</span> <i>Step 3</i></a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span
                                            class="round-tab">4</span> <i>Step 4</i></a>
                                </li>
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('admine.store') }}" enctype="multipart/form-data"
                            role="form" class="login-box">
                            @csrf
                            <div class="tab-content" id="main_form">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <h4 class="text-center">Step 1</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>objet:</label>
                                                <input class="form-control" type="text" id="objet" name="objet"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Numero:</label>
                                                <input class="form-control" type="text" id="numero" name="numero"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">
                                    <h4 class="text-center">Step 2</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Destinateur:</label>
                                                <input class="form-control" type="text"
                                                    id="destinateurt"name="destinateurt" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Destinataire:</label>
                                                <input class="form-control" type="text" id="destinataire"
                                                    name="destinataire" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h4 class="text-center">Step 3</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date:</label>
                                                <input class="form-control" type="date" id="date" name="date"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Division:</label>
                                                <select class="form-control"id="division_id" name="division_id" required>
                                                    <option value="" disabled selected>Select Division</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Service:</label>
                                                <select class="form-control" id="service_id" name="service_id" required>
                                                    <option value="" disabled selected>Select service</option>
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step4">
                                    <h4 class="text-center">Step 4</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Categorie:</label>
                                                <select class="form-control" id="categorie_id" name="categorie_id"
                                                    required>
                                                    <option value="" disabled selected>Select Categorie</option>
                                                    @foreach ($categories as $categorie)
                                                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>Fichier (PDF):</label>
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="fichier"
                                                        name="fichier" accept=".pdf" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="default-btn prev-step">Back</button></li>
                                        <li> <button onclick="showAlert('Bien créé')" type="submit"class="btn btn-primary">Creat</button></li>
                                    </ul>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
        </div>
        </div>

        </div>

        </div>

        </div>
        </div>
        </div>
        </div>
    </section>
    @endsection
@section('script')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // ------------javascript of step progess -------------
        $(document).ready(function() {
            $(".nav-tabs > li a[title]").tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
                var target = $(e.target);

                if (target.parent().hasClass("disabled")) {
                    return false;
                }
            });

            $(".next-step").click(function(e) {
                var active = $(".wizard .nav-tabs li.active");
                active.next().removeClass("disabled");
                nextTab(active);
            });
            $(".prev-step").click(function(e) {
                var active = $(".wizard .nav-tabs li.active");
                prevTab(active);
            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

        $(".nav-tabs").on("click", "li", function() {
            $(".nav-tabs li.active").removeClass("active");
            $(this).addClass("active");
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function showAlert(message) {
        Swal.fire({
            position: "top-center",
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 4500
        });
    }
</script>
@endsection

