<div>
    <!-- Portfolio-->
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row g-0">
            @foreach ($projects as $project)
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="data:image/{{$project->PRO_IMAGExt}};base64,{{$project->PRO_IMAGE}} " title="{{ $project->PRO_DESC }}" >
                   
                    <img src="data:image/{{$project->PRO_IMAGExt}};base64,{{$project->PRO_IMAGE}}" class="img-fluid" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-name">{{ $project->PRO_NAME }}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div>{{$projects->links('livewire.componentes.pagination')}}</div>
    </div>
</div>
</div>
