<?php

namespace artkost\qa\widgets;

use artkost\qa\models\FavoriteInterface;
use Yii;
use yii\base\Widget;

/**
 * @author Nikolay Kostyurin <nikolay@artkost.ru>
 * @since 2.0
 */
class Favorite extends Widget
{
    public $limit = 10;
    public $userID = 0;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $model = Yii::$container->get(FavoriteInterface::CLASS_NAME);

        $models = $model::find()
            ->limit($this->limit)
            ->where(['user_id' => $this->userID])
            ->with('question')
            ->all();

        return $this->render('favorite', [
            'models'  => $models,
        ]);
    }
}