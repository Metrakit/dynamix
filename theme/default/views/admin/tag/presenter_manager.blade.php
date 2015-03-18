        <section class="tag">
            <h2 class="text-capitalize">{{ $lang->name_locale }}</h2>
            @foreach($lang->tags() as $tag)
            <span class="tag-king-blue">
                <div class="btn-absolute">
                    {{ Form::open(array('url' => 'admin/tag/' . $tag->id, 'class' => 'pull-right')) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <button type="submit" class="btn btn-transparent-white btn-xs remove"><span class="glyphicon glyphicon-remove"></span></button>
                    {{ Form::close() }}
                    <div class="pull-right"><a href="{{URL::to('admin/tag/' . $tag->id . '/edit')}}" class="btn btn-xs btn-transparent-white pencil"><span class="glyphicon glyphicon-pencil"></span></a></div>
                    <div class="clearfix"></div>
                </div>
                <span class="glyphicon glyphicon-tag"></span> <span>{{$tag->text}}</span>
            </span>
            @endforeach
        </section>