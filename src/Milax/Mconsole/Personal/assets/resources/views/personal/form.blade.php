<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('personal/%s', $item->id) : 'personal') }}" enctype="multipart/form-data">
	@if (isset($item))@method('PUT')@endif
	@csrf

<div class="row">
	<div class="col-lg-7 col-md-6">
		<div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('personal'),
                'title' => trans('mconsole::forms.tabs.main'),
                'fullscreen' => true,
            ])
			<div class="portlet-body form">
                <div class="form-body">
					<div class="form-group">
						<label>{{ trans('mconsole::personal.form.slug') }}</label>
						<div class="input-group">
							<input class="form-control {{ isset($class) ? $class : '' }}" type="text" autocomplete="off" placeholder="" name="slug" value="{{ isset($item->slug) ? $item->slug : (is_null(old('slug')) ? null : old('slug')) }}">

							<span class="input-group-btn">
								<button class="btn blue slugify" type="button">
								<i class="fa fa-refresh fa-fw"></i> {{ trans('mconsole::personal.form.slugify') }}</button>
							</span>
						</div>
					</div>

                    <div class="tabbable-line">
						<ul class="nav nav-tabs">
                            @foreach ($languages as $key => $language)
    							<li @if ($key == 0) class="active" @endif>
    								<a href="#lang_{{ $language->id }}" data-toggle="tab"> {{ $language->name }}  </a>
    							</li>
                            @endforeach
						</ul>
						<div class="tab-content">
                            @foreach ($languages as $key =>$language)
    							<div class="tab-pane fade @if ($key == 0) active @endif in" id="lang_{{ $language->id }}">
                                    @include('mconsole::forms.text', [
                						'label' => trans('mconsole::personal.form.name'),
                						'name' => 'name[' . $language->key . ']',
										'value' => $item->name[$language->key] ?? null,
                					])
                                    <hr />
                                    <h3>{{ trans('mconsole::personal.form.content') }}</h3>
                                    @include('mconsole::forms.text', [
                                        'label' => trans('mconsole::personal.form.position'),
                                        'name' => 'position[' . $language->key . ']',
										'value' => $item->position[$language->key] ?? null,
                                    ])
                					@if (app('API')->options->getByKey('textareatype') == 'ckeditor')
                                        @include('mconsole::forms.ckeditor', [
                                            'label' => trans('mconsole::personal.form.contacts'),
                                            'name' => 'contacts[' . $language->key . ']',
											'value' => $item->contacts[$language->key] ?? null,
                                        ])
                                        @include('mconsole::forms.ckeditor', [
                                            'label' => trans('mconsole::personal.form.preview'),
                    						'name' => 'preview[' . $language->key . ']',
											'value' => $item->preview[$language->key] ?? null,
                                        ])
                                        @include('mconsole::forms.ckeditor', [
                                            'label' => trans('mconsole::personal.form.biography'),
                    						'name' => 'biography[' . $language->key . ']',
											'value' => $item->biography[$language->key] ?? null,
                                        ])
                                    @else
                                        @include('mconsole::forms.textarea', [
                                            'label' => trans('mconsole::personal.form.contacts'),
                                            'name' => 'contacts[' . $language->key . ']',
											'size' => '50x4',
											'value' => $item->contacts[$language->key] ?? null,
                                        ])
                                        @include('mconsole::forms.textarea', [
                    						'label' => trans('mconsole::personal.form.preview'),
                    						'name' => 'preview[' . $language->key . ']',
                                            'size' => '50x4',
											'value' => $item->preview[$language->key] ?? null,
                    					])
                    					@include('mconsole::forms.textarea', [
                    						'label' => trans('mconsole::personal.form.biography'),
                    						'name' => 'biography[' . $language->key . ']',
                                            'size' => '50x15',
											'value' => $item->biography[$language->key] ?? null,
                    					])
                                    @endif
                                    <hr />
                                    <h3>{{ trans('mconsole::personal.form.seo') }}</h3>
                                    @include('mconsole::forms.text', [
    									'label' => trans('mconsole::personal.form.title'),
    									'name' => 'title[' . $language->key . ']',
										'value' => $item->title[$language->key] ?? null,
    								])
    								@include('mconsole::forms.text', [
    									'label' => trans('mconsole::personal.form.description'),
    									'name' => 'description[' . $language->key . ']',
										'value' => $item->description[$language->key] ?? null,
    								])
    							</div>
                            @endforeach
						</div>
					</div>

                    {!! app('API')->forms->constructor->render() !!}

                </div>
                <div class="form-actions">
                    @include('mconsole::forms.submit')
                </div>
			</div>
		</div>
	</div>
	<div class="col-lg-5 col-md-6">
        @if (app('API')->options->getByKey('personal_has_cover') || app('API')->options->getByKey('personal_has_gallery'))
            <div class="portlet light">
				@if (app('API')->options->getByKey('personal_has_cover'))
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject font-blue sbold uppercase">{{ trans('mconsole::personal.form.cover') }}</span>
						</div>
					</div>
					<div class="portlet-body form">
						@include('mconsole::forms.upload', [
							'type' => MconsoleUploadType::Image,
							'multiple' => false,
							'group' => 'cover',
							'preset' => 'personal',
							'id' => isset($item) ? $item->id : null,
							'model' => 'Milax\Mconsole\Personal\Models\Person',
						])
					</div>
				@endif
				@if (app('API')->options->getByKey('personal_has_gallery'))
					@include('mconsole::partials.portlet-title', [
						'title' => trans('mconsole::personal.form.gallery'),
					])
					<div class="portlet-body">
						@include('mconsole::forms.upload', [
							'type' => MconsoleUploadType::Image,
							'multiple' => true,
							'group' => 'gallery',
							'preset' => 'personal-gallery',
							'id' => isset($item) ? $item->id : null,
							'model' => 'Milax\Mconsole\Personal\Models\Person',
						])
					</div>
				@endif
            </div>
		@endif
        
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-blue sbold uppercase">{{ trans('mconsole::forms.tags.label') }}</span>
				</div>
			</div>
			<div class="portlet-body form">
                @if (isset($item))
                    @include('mconsole::forms.tags', [
                        'tags' => $item->tags,
                        'categories' => ['personal'],
                    ])
                @else
                    @include('mconsole::forms.tags', [
                        'categories' => ['personal'],
                    ])
                @endif
			</div>
		</div>

		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<span class="caption-subject font-blue sbold uppercase">{{ trans('mconsole::forms.tabs.settings') }}</span>
				</div>
			</div>
			<div class="portlet-body form">
				@include('mconsole::partials.note', [
					'text' => trans('mconsole::personal.info.weight'),
				])
				@include('mconsole::forms.text', [
					'label' => trans('mconsole::personal.form.weight'),
					'name' => 'weight',
					'value' => $item->weight ?? 0,
				])
                @include('mconsole::forms.select', [
                    'label' => trans('mconsole::personal.form.enabled'),
                    'name' => 'enabled',
                    'type' => MconsoleFormSelectType::YesNo,
					'value' => $item->enabled ?? null,
                ])
			</div>
		</div>
	</div>
</div>

</form>

@section('page.scripts')
    <script src="/massets/js/slugify.js" type="text/javascript"></script>
	<script type="text/javascript">
		var slug = $('input[name="slug"]');
		$('.slugify').click(function () {
			slug.prop('disabled', true);
			slugify($('input[name*="name"]'), function (text) {
				slug.val(text);
				slug.prop('disabled', false);
			});
		});
	</script>
@endsection
