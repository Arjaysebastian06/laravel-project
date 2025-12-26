<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Careers Page</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">

<style>
    #careers-table td { border: none !important; padding: 0.75rem 0; }
</style>
</head>
<body>

<main class="container py-5">
    <h2 class="fw-bolder text-danger mb-2">Careers</h2>
    <h3 class="fs-6 fw-bold mb-4">Find your next opportunity</h3>

    <div class="row">
        <!-- LEFT COLUMN: Filters + Job Listings -->
        <div class="col-md-8 mb-5">
            <!-- FILTERS -->
            <div class="row mb-4 g-3">
                <!-- Top line: Job Title + Job Type -->
                <div class="col-md-6">
                    <label class="fw-bold">Job Title</label>
                    <select class="form-select" id="filter-job-title">
                        <option value="">All</option>
                        <option value="Sales Manager">Sales Manager</option>
                        <option value="Developer">Developer</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">Job Type</label>
                    <select class="form-select" id="filter-job-type">
                        <option value="">All</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                    </select>
                </div>

                <!-- Second line: City + State + Country -->
                <div class="col-md-4">
                    <label class="fw-bold">City</label>
                    <select class="form-select" id="filter-city">
                        <option value="">All</option>
                        <option value="Amsterdam">Amsterdam</option>
                        <option value="Madrid">Madrid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="fw-bold">State</label>
                    <select class="form-select" id="filter-state">
                        <option value="">All</option>
                        <option value="Noord-Holland">Noord-Holland</option>
                        <option value="Madrid">Madrid</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="fw-bold">Country</label>
                    <select class="form-select" id="filter-country">
                        <option value="">All</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Spain">Spain</option>
                    </select>
                </div>
            </div>

            <!-- JOB LISTINGS TABLE -->
            <table id="careers-table" class="table table-borderless w-100">
                <thead><tr><th></th></tr></thead>
                <tbody>
                    <tr data-job-title="HQTS Netherlands" data-job-type="Full-time" data-country="Netherlands" data-state="Noord-Holland" data-city="Amsterdam">
                        <td>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold text-danger">HQTS Netherlands</span>
                                <span class="fw-bold text-secondary">Sales Department Manager</span>
                            </div>
                            <div class="mb-2 text-muted">Amsterdam, Noord-Holland, Netherlands</div>
                            <div class="d-flex justify-content-between">
                                <div class="text-muted">Management, Sales</div>
                                <a href="#" class="text-danger">More Details →</a>
                            </div>
                            <hr>
                        </td>
                    </tr>
                    <tr data-job-title="Spain B2B" data-job-type="Part-time" data-country="Spain" data-state="Madrid" data-city="Madrid">
                        <td>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-bold text-danger">Web Developer</span>
                                {{-- <span class="fw-bold text-secondary">Sales Department Manager</span> --}}
                            </div>
                            <div class="mb-2 text-muted">Lot 1, Blk 13, Cecilia Village 1, Brgy. M.S. Garcia, Cabanatuan City, Nueva Ecija, Philippines	</div>
                            <div class="d-flex justify-content-between">
                                <div class="text-muted">Full-Time</div>
                                <a href="#" class="text-danger">More Details →</a>
                            </div>
                            <hr>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- RIGHT COLUMN: Contact Form -->
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
                            <textarea class="form-control" rows="4" placeholder="Please let us know about the supplier location and the service you require"></textarea>
                        </div>
                        <button class="btn btn-danger w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</main>

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
    const table = $('#careers-table').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: false,
        info: false,
        lengthMenu: [5, 10, 25, 50],
        language: { search: "_INPUT_", searchPlaceholder: "Search jobs..." }
    });

    // FILTERING
$('#filter-job-title, #filter-job-type, #filter-city, #filter-state, #filter-country').on('change', function() {
    const title = $('#filter-job-title').val().toLowerCase();
    const type = $('#filter-job-type').val().toLowerCase();
    const city = $('#filter-city').val().toLowerCase();
    const state = $('#filter-state').val().toLowerCase();
    const country = $('#filter-country').val().toLowerCase();

    let visibleCount = 0;

    table.rows().every(function() {
        const row = $(this.node());
        const rowTitle = row.data('job-title').toLowerCase();
        const rowType = row.data('job-type').toLowerCase();
        const rowCity = row.data('city').toLowerCase();
        const rowState = row.data('state').toLowerCase();
        const rowCountry = row.data('country').toLowerCase();

        if (
            (title === "" || rowTitle.includes(title)) &&
            (type === "" || rowType.includes(type)) &&
            (city === "" || rowCity.includes(city)) &&
            (state === "" || rowState.includes(state)) &&
            (country === "" || rowCountry.includes(country))
        ) {
            row.show();
            visibleCount++;
        } else {
            row.hide();
        }
    });

    // CHECK IF NO ROW VISIBLE
    if(visibleCount === 0) {
        if ($('#careers-table tbody .no-jobs').length === 0) {
            $('#careers-table tbody').append('<tr class="no-jobs"><td class="text-center text-muted">No jobs available</td></tr>');
        }
    } else {
        $('#careers-table tbody .no-jobs').remove();
    }
});

});
</script>

</body>
</html>
