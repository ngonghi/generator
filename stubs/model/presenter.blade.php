namespace App\Presenters;

use LaravelRocket\Foundation\Presenters\BasePresenter;

/**
 *
 * @property \App\Models\{{ $modelName }} $entity
@foreach($columns as $name => $type)
 * @property {{ $type }} ${{ $name }}
@endforeach
 */

class {{ $modelName }}Presenter extends BasePresenter
{

    protected $multilingualFields = [
@foreach( $multilingualFields as $multilingualField )
    '{{ $multilingualField }}',
@endforeach
    ];

    protected $imageFields = [
@foreach( $imageColumns as $imageColumn )
    '{{ $imageColumn }}',
@endforeach
    ];

@foreach( $relations as $relation )
@if( $relation['type'] === 'belongsTo' || $relation['type'] === 'hasOne' )
    public function {{ $relation['name'] }}()
    {
        $model = $this->entity->{{ $relation['name'] }};
        if (!$model) {
            $model      = new \App\Models\{{ $relation['referenceModel'] }}();
@if( ends_with(strtolower($relation['name']), 'image'))
@if( $authenticatable )
            $model->url = \URLHelper::asset('images/user.png', 'common');
@else
            $model->url = \URLHelper::asset('images/local.png', 'common');
@endif
@endif
        }
        return $model;
    }
@endif
@endforeach

}
