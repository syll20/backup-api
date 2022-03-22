<?php
 
namespace App\View\Composers;

use App\Models\Scorer;
use Illuminate\View\View;
 
class ScorerComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Models\Scorer
     */
    protected $scorers;
 
    /**
     * Create a new profile composer.
     *
     * @param  \App\Models\Scorer  $scorers
     * @return void
     */
    public function __construct(Scorer $scorers)
    {
        // Dependencies are automatically resolved by the service container...
        $this->scorers = $scorers;
    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $total = $this->scorers->getAllOrderBy('total', 'desc');
        $home = $this->scorers->getAllOrderBy('home', 'desc');
        $away = $this->scorers->getAllOrderBy('away', 'desc');
        

        $view->with('homeScorers', $home)
            ->with('awayScorers', $away)
            ->with('totalScorers', $total);
    }
}