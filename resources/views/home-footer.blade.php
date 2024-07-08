<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

<!-- Load Plugin js -->
@if (isset($plugin))
    <!-- SweetAlert2 https://sweetalert2.github.io/ -->
    @if (in_array('sweet-alert', $plugin))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{URL::asset('js/sweet-alert.js')}}"></script>
    @endif

    <!-- Select2 https://select2.org/ -->
    @if (in_array('select2', $plugin))
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{URL::asset('js/select2.js')}}"></script>
    @endif

    <!-- DataTables https://datatables.net/ -->
    @if (in_array('datatables', $plugin))
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
    @endif
@endif

<!-- Load JS Kalian -->
@if (isset($js) && is_array($js))
    @foreach ($js as $key)
        <script src="{{URL::asset('js/'.$key)}}"></script>
    @endforeach
@endif
</body>

</html>