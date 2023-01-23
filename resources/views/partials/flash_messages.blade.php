@push('js')
    <script>
        @foreach (session('flash_notification', collect())-> toArray() as $message)
        $.notify("{!! $message['message'] !!}", "{{ ($message['level']!='danger')?$message['level']:'error' }}");
        @endforeach
    </script>
@endpush
