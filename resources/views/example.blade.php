<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Example</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
    <table id="example" class="table table-borderless job-table w-100">
        <thead>
            <tr><th></th></tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-danger mb-1">
                                HQTS Netherlands – Sales Department Manager
                            </h5>
                            <small class="text-muted">
                                Amsterdam, Eindhoven, Rotterdam
                            </small>
                        </div>
                        <div class="text-end">
                            <div class="text-muted">Management, Sales</div>
                            <a href="#" class="text-danger">More Details →</a>
                        </div>
                    </div>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-danger mb-1">
                                Spain B2B Sales Department Manager
                            </h5>
                            <small class="text-muted">Madrid</small>
                        </div>
                        <div class="text-end">
                            <div class="text-muted">Sales</div>
                            <a href="#" class="text-danger">More Details →</a>
                        </div>
                    </div>
                    <hr>
                </td>
            </tr>

        </tbody>
    </table>
</div>

<div class="col-md-4">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white text-center fw-bold">
            Need More Information?
        </div>

        <div class="card-body">
            <form>
                <div class="mb-2">
                    <label>Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Company <span class="text-danger">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Your Country <span class="text-danger">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-2">
                    <label>Your Product <span class="text-danger">*</span></label>
                    <input type="text" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Message</label>
                    <textarea class="form-control" rows="4"
                        placeholder="Please let us know about the supplier location and the service you require"></textarea>
                </div>

                <button class="btn btn-danger w-100">Submit</button>
            </form>
        </div>
    </div>
</div>

    </div>
</div>




<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthMenu: [5, 10, 25, 50, 100],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    });
</script>

</body>
</html>
