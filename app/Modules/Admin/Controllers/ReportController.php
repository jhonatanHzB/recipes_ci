<?php

namespace App\Modules\Admin\Controllers;

use App\Handlers\Reports\CategoriesExcelReport;
use App\Handlers\Reports\RecipesWithTagsExcelReport;
use App\Handlers\Reports\Strategy\ExcelReportContext;
use App\Handlers\Reports\RecipesWithCategoryExcelReport;
use App\Handlers\Reports\RecipesWithoutCategoryExcelReport;
use App\Handlers\Reports\TagsExcelReport;
use App\Modules\Admin\Models\CategoryModel;
use App\Modules\Admin\Models\RecipeModel;
use App\Modules\Admin\Models\TagModel;
use CodeIgniter\HTTP\ResponseInterface;

class ReportController extends BaseController
{

    protected CategoryModel $categoryModel;
    protected RecipeModel $recipeModel;
    protected TagModel $tagModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->recipeModel = new RecipeModel();
        $this->tagModel = new TagModel();
    }

    public function exportCategoriesToExcel(): ResponseInterface
    {
        $categories = $this->categoryModel->findAll();
        $reportContext = new ExcelReportContext();

        $reportContext->setStrategy(new CategoriesExcelReport());
        $tempFile = $reportContext->executeStrategy($categories, 'categorias.xlsx');

        return $this->response->download($tempFile, null)->setFileName('categorias.xlsx');
    }

    public function exportRecipesWithCategoryToExcel(): ResponseInterface
    {
        $recipes = $this->recipeModel->getRecipesWithCategories();
        $reportContext = new ExcelReportContext();

        $reportContext->setStrategy(new RecipesWithCategoryExcelReport());
        $tempFile = $reportContext->executeStrategy($recipes, 'recetas_con_categoria.xlsx');

        return $this->response->download($tempFile, null)->setFileName('recetas_con_categoria.xlsx');
    }

    public function exportRecipesWithoutCategoryToExcel(): ResponseInterface
    {
        $recipes = $this->recipeModel->getRecipesWithoutCategories();
        $reportContext = new ExcelReportContext();

        $reportContext->setStrategy(new RecipesWithoutCategoryExcelReport());
        $tempFile = $reportContext->executeStrategy($recipes, 'recetas_sin_categoria.xlsx');

        return $this->response->download($tempFile, null)->setFileName('recetas_sin_categoria.xlsx');
    }

    public function exportTagsToExcel(): ResponseInterface
    {
        $tags = $this->tagModel->findAll();
        $reportContext = new ExcelReportContext();

        $reportContext->setStrategy(new TagsExcelReport());
        $tempFile = $reportContext->executeStrategy($tags, 'etiquetas.xlsx');

        return $this->response->download($tempFile, null)->setFileName('etiquetas.xlsx');
    }

    public function exportRecipesWithTagToExcel(): ResponseInterface
    {
        $recipes = $this->recipeModel->getRecipesWithTags();
        $reportContext = new ExcelReportContext();

        $reportContext->setStrategy(new RecipesWithTagsExcelReport());
        $tempFile = $reportContext->executeStrategy($recipes, 'recetas_con_etiqueta.xlsx');

        return $this->response->download($tempFile, null)->setFileName('recetas_con_etiqueta.xlsx');
    }

}