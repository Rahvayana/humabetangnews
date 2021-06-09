<footer class="app-footer">
    <div class="mx-auto mx-sm-0">
    <a class="text-center text-sm-left" href="{{url('/')}}">
        {{ $config->web_app_name }}
        </a>
        <span class="text-center text-sm-left">
            {{ $config->footer }}
        </span>
    </div>
    <div class="mx-auto mr-sm-2">
        <span>
            Powered by
        </span>
    <a href="{{url('/')}}">
        {{ $config->web_app_name }}
        </a>
    </div>
</footer>