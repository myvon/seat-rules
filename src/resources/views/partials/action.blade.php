<a href="{{ route('rules.edit', ['rule' => $rule->id]) }}" class="btn btn-sm btn-warning">
    <i class="fas fa-pencil-alt"></i> {{ trans('web::seat.edit') }}
</a>
<a href="{{ route('rules.delete', ['rule' => $rule->id]) }}" class="btn btn-sm btn-danger">
    <i class="fas fa-trash-alt"></i> {{ trans('web::seat.delete') }}
</a>