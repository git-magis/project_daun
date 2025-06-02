// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTableLargeEntry').DataTable({
    paging: false,
    searching: false,
    ordering: true,
    info: false
  });
});

$(document).ready(function() {
  $('#dataTable').DataTable();
});
