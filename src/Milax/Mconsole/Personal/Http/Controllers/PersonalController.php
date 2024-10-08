<?php

namespace Milax\Mconsole\Personal\Http\Controllers;

use Milax\Mconsole\Http\Controllers\ModuleController as Controller;
use Milax\Mconsole\Personal\Http\Requests\PersonalRequest;
use Milax\Mconsole\Personal\Models\Person;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;

/**
 * Personal module controller file
 */
class PersonalController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;

    protected $model = 'Milax\Mconsole\Personal\Models\Person';
    protected $list, $form, $redirectTo, $person, $module;

    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, Person $person)
    {
        parent::__construct();

        $this->setCaption(trans('mconsole::personal.menu'));

        $this->list = $list;
        $this->form = $form;
        $this->person = $person;
        $this->redirectTo = mconsole_url('personal');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->list->setText(trans('mconsole::personal.form.name'), 'name')
            ->setText(trans('mconsole::personal.form.position'), 'position')
            ->setSelect(trans('mconsole::settings.options.enabled'), 'enabled', [
                '1' => trans('mconsole::settings.options.on'),
                '0' => trans('mconsole::settings.options.off'),
            ], true);

        return $this->list->setQuery($this->person)->setAddAction('personal/create')->render(function ($item) {
            return [
                trans('mconsole::tables.state') => view('mconsole::indicators.state', $item),
                trans('mconsole::tables.id') => $item->id,
                trans('mconsole::personal.table.updated') => $item->updated_at->format('m.d.Y'),
                trans('mconsole::personal.table.name') => collect($item->name)->transform(function ($val, $key) {
                    if (!is_null($val) && strlen($val) > 0) {
                        return sprintf('<div class="label label-info">%s</div> %s', $key, $val);
                    }
                })->values()->implode('<br />'),
                trans('mconsole::personal.table.position') => collect($item->position)->transform(function ($val, $key) {
                    if (!is_null($val) && strlen($val) > 0) {
                        return sprintf('<div class="label label-info">%s</div> %s', $key, $val);
                    }
                })->values()->implode('<br />'),
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->form->render('mconsole::personal.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Milax\Mconsole\Personal\Http\Requests\PersonalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalRequest $request)
    {
        $person = $this->person->create($request->all());
        $this->handleUploads($person);
        app('API')->tags->sync($person);

        $this->redirect();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->form->render('mconsole::personal.form', [
            'item' => $this->person->query()->with('uploads')->findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Milax\Mconsole\Personal\Http\Requests\PersonalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalRequest $request, $id)
    {
        $person = $this->person->find($id);

        $this->handleUploads($person);
        app('API')->tags->sync($person);
        
        $person->update($request->all());

        $this->redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $person = $this->person->find($id);

        if ($person->system) {
            return redirect()->back()->withErrors(trans('mconsole::mconsole.errors.system'));
        }

        $person->delete();

        $this->redirect();
    }

    /**
     * Handle uploads upload
     *
     * @param Milax\Mconsole\Personal\Models\Person $person [Person object]
     * @return void
     */
    protected function handleUploads($person)
    {
        // Images processing
        app('API')->uploads->handle(function ($uploads) use (&$person) {
            app('API')->uploads->attach([
                'group' => 'gallery',
                'uploads' => $uploads,
                'related' => $person,
            ]);
            app('API')->uploads->attach([
                'group' => 'cover',
                'uploads' => $uploads,
                'related' => $person,
                'unique' => true,
            ]);
        });
    }
}
