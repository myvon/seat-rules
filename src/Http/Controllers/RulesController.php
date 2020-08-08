<?php


namespace Lvlo\Rules\Http\Controllers;


use Illuminate\Support\Facades\App;
use Lvlo\Rules\Http\DataTables\RulesDataTable;
use Lvlo\Rules\Http\Validation\Rule;
use Lvlo\Rules\Models\Rules;
use Seat\Eveapi\Models\Alliances\Alliance;
use Seat\Eveapi\Models\Character\CharacterInfo;
use Seat\Eveapi\Models\Corporation\CorporationInfo;
use Seat\Eveapi\Models\Universe\UniverseName;
use Seat\Web\Http\Controllers\Controller;

class RulesController extends Controller
{
    public function showLang($lang)
    {
        return view('rules::rules', ['rules' => $this->getRules($lang)]);
    }

    public function show()
    {
        $lang = setting('language');

        return view('rules::rules', ['rules' => $this->getRules($lang)]);
    }

    private function getRules($lang)
    {
        /** @var CharacterInfo $characters */
        $character = auth()->user()->character()->first();

        $corporation = null;
        $alliance = null;

        /** @var CorporationInfo $corporation */
        $corporation = $character->corporation()->first();

        $alliance = $corporation->alliance()->first();
        if (!$alliance instanceof Alliance) {
            $alliance = null;
        }

        $allLanguage = config('web.locale.languages');

        $rules = [
            'corporation' => null,
            'alliance' => null,
            'corporation_langs' => null,
            'corporation_lang' => null,
            'alliance_langs' => null,
            'alliance_lang' => null,
        ];

        if($corporation !== null) {
            $id = $corporation->corporation_id;
            $rules['corporation'] = Rules::where(['object_type' => 'corporation', 'object_id' => $id, 'language' => $lang])->first();
            if(!$rules['corporation'] instanceof Rules) {
                $rules['corporation'] = Rules::where(['object_type' => 'corporation', 'object_id' => $id])->first();
            }

            if($rules['corporation'] instanceof Rules) {

                $rules['corporation_langs'] = [];
                $rules['corporation_lang'] = "";
                $rules['corporation_lang'] = $rules['corporation']->language;

                $allRules = Rules::where(['object_type' => 'corporation', 'object_id' => $id])->get();
                $languages = [];
                foreach ($allRules as $rule) {
                    $languages[] = $rule->language;
                }

                foreach ($allLanguage as $lang) {
                    if (in_array($lang['short'], $languages)) {
                        $rules['corporation_langs'] = $lang;
                    }

                }
            }
        }

        if($alliance !== null) {
            $rules['alliance'] = Rules::where(['object_type' => 'alliance', 'object_id' => $alliance->alliance_id, 'language' => $lang])->first();
            if(!$rules['alliance'] instanceof Rules) {
                $rules['alliance'] = Rules::where(['object_type' => 'alliance', 'object_id' => $alliance->alliance_id])->first();
            }

            if($rules['alliance'] instanceof Rules) {
                $rules['alliance_langs'] = [];
                $rules['alliance_lang'] = $rules['alliance']->language;

                $allRules = Rules::where(['object_type' => 'alliance', 'object_id' => $alliance->alliance_id])->get();
                $languages = [];
                foreach ($allRules as $rule) {
                    $languages[] = $rule->language;
                }

                foreach ($allLanguage as $lang) {
                    if (in_array($lang['short'], $languages)) {
                        $rules['alliance_langs'][] = $lang;
                    }

                }
            }
        }

        return $rules;
    }

    public function listRules(RulesDataTable  $dataTable)
    {
        return $dataTable
            ->render('rules::list');
    }

    public function create()
    {
        $corporations = CorporationInfo::all();
        $alliances = Alliance::all();
        $languages = config('web.locale.languages');

        return view('rules::create', ['corporations' => $corporations,'alliances' => $alliances, 'languages' => $languages]);
    }

    public function store(Rule $request)
    {
        list($object_type, $object_id) = explode(',', $request->input('object'));

        $rule = Rules::create([
            'object_type' => $object_type,
            'object_id' => $object_id,
            'content' => $request->input('content'),
            'language' => $request->input('language'),
        ]);

        return redirect()->route('rules.list')
            ->with('success', 'Rules has successfully been created.');
    }

    public function edit(Rules  $rule)
    {
        return view('rules::edit', ['rule' => $rule]);
    }

    public function update(Rules $rule, Rule  $request)
    {
        $rule->content = $request->input('content');
        $rule->update();

        return redirect()->route('rules.list')
            ->with('success', 'Rules has successfully been updated.');
    }

    public function remove(Rules $rule)
    {
        $rule->delete();
        return redirect()->route('rules.list')
            ->with('success', 'Rules has successfully been removed.');
    }
}