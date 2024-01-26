<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">หน้าหลัก</a>
                    </li>
                    @if(isset($pageTitleItmas) && !empty($pageTitleItmas))
                    @foreach($pageTitleItmas as $row)
                    @if(isset($row['url']) && !empty($row['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ (isset($row['url']))? $row['url'] : '#' }}">{{ (isset($row['name']))? $row['name'] : '' }}</a>
                    </li>
                    @else
                    <li class="breadcrumb-item active">{{ (isset($row['name']))? $row['name'] : '' }}</li>
                    @endif
                    @endforeach
                    @endif
                </ol>
            </div> 
            <h4 class="page-title"> {{ $pageName }} </h4>
        </div>
    </div>
</div>
 