<?php
isset($layout) ? "": $layout = "list";

/*isset($selected_category_id) ? "": $selected_category_id = "all";
isset($selected_level) ? "": $selected_level = "all";
isset($selected_language) ? "": $selected_language = "all";
isset($selected_rating) ? "": $selected_rating = "all";
isset($selected_price) ? "": $selected_price = "all";*/

/*echo "<pre>";
print_r($selected_category_id);exit;*/


isset($selected_category_id) ? "": $selected_category_id = ['all'];
isset($selected_level) ? "": $selected_level = ['all'];
isset($selected_language) ? "": $selected_language = ['all'];
isset($selected_rating) ? "": $selected_rating = ['all'];
isset($selected_price) ? "": $selected_price = ['all'];

if(!empty($_GET['category']))
{
    if(in_array('all', json_decode($_GET['category'])) && !in_array('all', $selected_category_id))
    {
      array_push($selected_category_id, 'all');
    }
}


if(!empty($_GET['level']))
{
    if(in_array('all', json_decode($_GET['level'])) && !in_array('all', $selected_level))
    {
      array_push($selected_level, 'all');
    }
}


if(!empty($_GET['language']))
{
    if(in_array('all', json_decode($_GET['language'])) && !in_array('all', $selected_language))
    {
      array_push($selected_language, 'all');
    }
}


if(!empty($_GET['rating']))
{
    if(in_array('all', json_decode($_GET['rating'])) && !in_array('all', $selected_rating))
    {
      array_push($selected_rating, 'all');
    }
}


if(!empty($_GET['price']))
{
    if(in_array('all', json_decode($_GET['price'])) && !in_array('all', $selected_price))
    {
      array_push($selected_price, 'all');
    }
}


$number_of_visible_categories = 10;
if (isset($sub_category_id)) {
    $sub_category_details = $this->crud_model->get_category_details_by_id($sub_category_id)->row_array();
    $category_details     = $this->crud_model->get_categories($sub_category_details['parent'])->row_array();
    $category_name        = $category_details['name'];
    $sub_category_name    = $sub_category_details['name'];
}
?>



<style>
/* The container */
.checkbox_label {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 13px;
  color: black;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.checkbox_label input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 21px;
  width: 22px;
  background-color: #ec5252;
}

/* On mouse-over, add a grey background color */
.checkbox_label:hover input ~ .checkmark {
  background-color: #ec5252;
}

/* When the checkbox is checked, add a blue background */
.checkbox_label input:checked ~ .checkmark {
  background-color: #ec5252;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkbox_label input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkbox_label .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>

<style type="text/css">
    .btn_clear{
    color: #686f7a !important;
    background-color: #fff !important;
    border: 1px solid #505763 !important;
    font-size: 12px !important;
    }

    .btn_clear:hover{
    color: #686f7a !important;
    background-color: #fff !important;
    border: 1px solid #505763 !important;
    font-size: 12px !important;
    }
</style>

<section class="category-header-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                <?php echo get_phrase('courses'); ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?php
                                /*if ($selected_category_id == "all") {
                                    echo get_phrase('all_category');
                                }else {
                                    $category_details = $this->crud_model->get_category_details_by_id($selected_category_id)->row_array();
                                    echo $category_details['name'];
                                }*/
                             ?>
                             Search
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="category-course-list-area">
    <div class="container">
        <div class="category-filter-box filter-box clearfix">
            <span>

              <?php

              if(!empty($limit))
               {
                  $curpage=$offset; 
                  if($curpage<$limit)
                  {
                      $result_start=1; 
                      $result_end=$curpage+$limit;
                  }

                  else
                  {
                      $result_start=$curpage+1;
                      $result_end=$curpage+$limit;
                      if($result_end>$total_records)
                      {
                        $result_end=$total_records;
                      }
                  }

                  if($result_end > $total_records)
                  {
                     $result_end = $total_records;
                  }

                  echo "Showing ".$result_start." to ".$result_end." of ".$total_records." entries";
                }

                else
                {
                   echo "&nbsp;";
                }

              ?>
                
            </span>
            <a href="javascript::" onclick="toggleLayout('grid')" style="float: right; font-size: 19px; margin-left: 5px;"><i class="fas fa-th"></i></a>
            <a href="javascript::" onclick="toggleLayout('list')" style="float: right; font-size: 19px;"><i class="fas fa-th-list"></i></a>
            <a href="<?php echo site_url('home/courses'); ?>" style="float: right; font-size: 19px; margin-right: 5px;"><i class="fas fa-sync-alt"></i></a>
        </div>
        <div class="row">
            <div class="col-lg-3 filter-area">
                <div class="card">
                    <!-- <a href="javascript::"  style="color: unset;"> -->
                        <!-- <div class="card-header filter-card-header" id="headingOne" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter"> -->
                        <div class="card-header filter-card-header" id="headingOne" aria-expanded="true" aria-controls="collapseFilter">
                            <h6 class="mb-0">
                                <?php echo get_phrase('filter'); ?>
                                <!-- <i class="fas fa-sliders-h" style="float: right;"></i> -->
                                
                                <a href="javascript:void(0);" class="clear_all_link" style="float: right !important;font-size: 15px;margin: auto;">Clear All</a>
                                
                            </h6>
                        </div>
                    <!-- </a> -->
                    <div id="collapseFilter" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body pt-0">
                            <div class="filter_type">
                                <h6><?php echo get_phrase('categories'); ?></h6>
                                <ul>
                                    <!-- <li class="ml-2"> -->
                                    <li class="">
                                        <div class="">
                                            <label for="category_all" class="checkbox_label"><?php echo get_phrase('all_category'); ?>
                                            <input type="checkbox" id="category_all" name="sub_category[]" class="categories" value="all" onclick="filter(this)" 

                                            <?php 

                                            if(in_array('all', $selected_category_id))
                                            {
                                               echo 'checked';
                                            }

                                            else if(count($selected_category_id)<1)
                                            {
                                               echo 'checked';
                                            }
                                                 
                                            ?> 

                                            >

                                            
                                            <span class="checkmark"></span>
                                            </label>
                                            
                                        </div>
                                    </li>
                                    <?php
                                    $counter = 1;
                                    $total_number_of_categories = $this->db->get('category')->num_rows();
                                    $categories = $this->crud_model->get_categories()->result_array();
                                    foreach ($categories as $category): ?>
                                        <li class="">
                                            <div class="<?php if ($counter > $number_of_visible_categories): ?> hidden-categories hidden <?php endif; ?>">
                                                <label for="category-<?php echo $category['id'];?>" class="checkbox_label"><?php echo $category['name']; ?>
                                                <input type="checkbox" id="category-<?php echo $category['id'];?>" name="sub_category[]" class="categories" value="<?php echo $category['slug']; ?>" onclick="filter(this)" 


                                                <?php 


                                                if(in_array($category['id'], $selected_category_id))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(in_array('all', $selected_category_id))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_category_id)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                                ?>


                                                >
                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </li>
                                        <?php foreach ($this->crud_model->get_sub_categories($category['id']) as $sub_category):
                                            $counter++; ?>
                                            <li class="ml-2">
                                                <div class="<?php if ($counter > $number_of_visible_categories): ?> hidden-categories hidden <?php endif; ?>">
                                                    <label for="sub_category-<?php echo $sub_category['id'];?>" class="checkbox_label"><?php echo $sub_category['name']; ?>
                                                    <input type="checkbox" id="sub_category-<?php echo $sub_category['id'];?>" name="sub_category[]" class="categories" value="<?php echo $sub_category['slug']; ?>" onclick="filter(this)" 


                                                    <?php 

                                                    if(in_array($category['id'], $selected_category_id) || in_array('all', $selected_category_id))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(in_array($sub_category['id'], $selected_category_id))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(in_array('all', $selected_category_id))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(count($selected_category_id)==0)
                                                    {
                                                       echo 'checked';
                                                    }

                                                         
                                                    ?>


                                                    >

                                                    <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="javascript::" id = "city-toggle-btn" onclick="showToggle(this, 'hidden-categories')" style="font-size: 12px;"><?php echo $total_number_of_categories > $number_of_visible_categories ? get_phrase('show_more') : ""; ?></a>
                            </div>
                            <hr>
                            <div class="filter_type">
                                <div class="form-group">
                                    <h6><?php echo get_phrase('price'); ?></h6>
                                    <ul>
                                        <li>
                                            <div class="">
                                                <label for="price_all" class="checkbox_label"><?php echo get_phrase('all'); ?>
                                                <input type="checkbox" id="price_all" name="price[]" class="prices" value="all" onclick="filter(this)" 


                                                <?php 

                                                if(in_array('all', $selected_price))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_price)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                                ?>


                                                >

                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="">
                                                <label for="price_free" class="checkbox_label"><?php echo get_phrase('free'); ?>
                                                <input type="checkbox" id="price_free" name="price[]" class="prices" value="free" onclick="filter(this)" 


                                                <?php 

                                                    if(in_array('free', $selected_price))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(in_array('all', $selected_price))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(count($selected_price)==0)
                                                    {
                                                       echo 'checked';
                                                    }
                                                         
                                                ?>

                                                >

                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="">
                                                <label for="price_paid" class="checkbox_label"><?php echo get_phrase('paid'); ?>
                                                <input type="checkbox" id="price_paid" name="price[]" class="prices" value="paid" onclick="filter(this)" 

                                                

                                                <?php 

                                                    if(in_array('paid', $selected_price))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(in_array('all', $selected_price))
                                                    {
                                                       echo 'checked';
                                                    }

                                                    else if(count($selected_price)==0)
                                                    {
                                                       echo 'checked';
                                                    }
                                                         
                                                ?>

                                                >

                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <div class="filter_type">
                                <h6><?php echo get_phrase('level'); ?></h6>
                                <ul>
                                    <li>
                                        <div class="">
                                            <label for="all" class="checkbox_label"><?php echo get_phrase('all'); ?>
                                            <input type="checkbox" id="all" name="level[]" class="level" value="all" onclick="filter(this)" 

                                            <?php 

                                                if(in_array('all', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_level)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                            ?>

                                            >

                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <label for="beginner" class="checkbox_label"><?php echo get_phrase('beginner'); ?>
                                            <input type="checkbox" id="beginner" name="level[]" class="level" value="beginner" onclick="filter(this)" 


                                            <?php 

                                                if(in_array('beginner', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(in_array('all', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_level)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                            ?>

                                            >

                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <label for="advanced" class="checkbox_label"><?php echo get_phrase('advanced'); ?>
                                            <input type="checkbox" id="advanced" name="level[]" class="level" value="advanced" onclick="filter(this)" 


                                            <?php 

                                                if(in_array('advanced', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(in_array('all', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_level)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                            ?>

                                            >

                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="">
                                            <label for="intermediate" class="checkbox_label"><?php echo get_phrase('intermediate'); ?>
                                            <input type="checkbox" id="intermediate" name="level[]" class="level" value="intermediate" onclick="filter(this)" 


                                            <?php 

                                                if(in_array('intermediate', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(in_array('all', $selected_level))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_level)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                            ?>

                                            >

                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <div class="filter_type">
                                <h6><?php echo get_phrase('language'); ?></h6>
                                <ul>
                                    <li>
                                        <div class="">
                                            <label for="<?php echo 'all_language'; ?>" class="checkbox_label"><?php echo get_phrase('all'); ?>
                                            <input type="checkbox" id="all_language" name="language[]" class="languages" value="<?php echo 'all'; ?>" onclick="filter(this)" 

                                              <?php 

                                                if(in_array('all', $selected_language))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_language)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                              ?>

                                            >

                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <?php
                                    $languages = $this->crud_model->get_all_languages();
                                    foreach ($languages as $language): ?>
                                        <li>
                                            <div class="">
                                                <label for="language_<?php echo $language; ?>" class="checkbox_label"><?php echo ucfirst($language); ?>
                                                <input type="checkbox" id="language_<?php echo $language; ?>" name="language[]" class="languages" value="<?php echo $language; ?>" onclick="filter(this)" 
                                           

                                                <?php 

                                                if(in_array($language, $selected_language))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(in_array('all', $selected_language))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_language)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                                ?>

                                                >

                                                <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <hr>
                            <div class="filter_type">
                                <h6><?php echo get_phrase('ratings'); ?></h6>
                                <ul>
                                    <li>
                                        <div class="">
                                            <label for="all_rating" class="checkbox_label"><?php echo get_phrase('all'); ?>
                                            <input type="checkbox" id="all_rating" name="rating[]" class="ratings" value="<?php echo 'all'; ?>" onclick="filter(this)" 


                                            <?php 

                                                if(in_array('all', $selected_rating))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_rating)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                            ?>

                                            >

                                            <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <li>
                                            <div class="">
                                                <label for="rating_<?php echo $i; ?>" class="checkbox_label">
                                                    <?php for($j = 1; $j <= $i; $j++): ?>
                                                        <i class="fas fa-star" style="color: #f4c150;"></i>
                                                    <?php endfor; ?>
                                                    <?php for($j = $i; $j < 5; $j++): ?>
                                                        <i class="far fa-star" style="color: #dedfe0;"></i>
                                                    <?php endfor; ?>
                                                <input type="checkbox" id="rating_<?php echo $i; ?>" name="rating[]" class="ratings" value="<?php echo $i; ?>" onclick="filter(this)" 


                                                <?php 

                                                if(in_array($i, $selected_rating))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(in_array('all', $selected_rating))
                                                {
                                                   echo 'checked';
                                                }

                                                else if(count($selected_rating)==0)
                                                {
                                                   echo 'checked';
                                                }
                                                     
                                                ?>

                                                >

                                                <span class="checkmark"></span>
                                                
                                                </label>
                                            </div>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="category-course-list">
                    <?php include 'category_wise_course_'.$layout.'_layout.php'; ?>
                    <?php if (count($courses) == 0): ?>
                        <?php echo get_phrase('no_result_found'); ?>
                    <?php endif; ?>
                </div>
                <nav>
                    <?php 
                    /*if ($selected_category_id == "all" && $selected_price == 0 && $selected_level == 'all' && $selected_language == 'all' && $selected_rating == 'all'){
                        echo $this->pagination->create_links();
                    }*/

                    echo $this->pagination->create_links();
                    ?>
                </nav>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

</script>

<script type="text/javascript">

function get_url() {
    var urlPrefix 	= '<?php echo site_url('home/courses?'); ?>'
    var urlSuffix = "";

    var slectedCategory = [];
    var selectedPrice = [];
    var selectedLevel = [];
    var selectedLanguage = [];
    var selectedRating = [];

    // Get selected category
    $('.categories:checked').each(function() {
        //slectedCategory = $(this).attr('value');
        slectedCategory.push($(this).attr('value'));
    });

    // Get selected price
    $('.prices:checked').each(function() {
        //selectedPrice = $(this).attr('value');
        selectedPrice.push($(this).attr('value'));
    });

    // Get selected difficulty Level
    $('.level:checked').each(function() {
        //selectedLevel = $(this).attr('value');
        selectedLevel.push($(this).attr('value'));
    });

    // Get selected difficulty Level
    $('.languages:checked').each(function() {
        //selectedLanguage = $(this).attr('value');
        selectedLanguage.push($(this).attr('value'));
    });

    // Get selected rating
    $('.ratings:checked').each(function() {
        //selectedRating = $(this).attr('value');
        selectedRating.push($(this).attr('value'));
    });

    //console.log(slectedCategory);return false;



    var slectedCategory = encodeURIComponent(JSON.stringify(slectedCategory));
    var selectedPrice = encodeURIComponent(JSON.stringify(selectedPrice));
    var selectedLevel = encodeURIComponent(JSON.stringify(selectedLevel));
    var selectedLanguage = encodeURIComponent(JSON.stringify(selectedLanguage));
    var selectedRating = encodeURIComponent(JSON.stringify(selectedRating));

    urlSuffix = "category="+slectedCategory+"&price="+selectedPrice+"&level="+selectedLevel+"&language="+selectedLanguage+"&rating="+selectedRating+"&page=0";
    var url = urlPrefix+urlSuffix;
    return url;
}
function filter(input='') {

    var name= input.getAttribute('name');
    if(name=="sub_category[]")
    {
       if(input.value!="all" && !input.checked)
       {
          $("#category_all").prop("checked", false);
       }
    }

    else if(name=="price[]")
    {
       if(input.value!="all" && !input.checked)
       {
          $("#price_all").prop("checked", false);
       }
    }

    else if(name=="level[]")
    {
       if(input.value!="all" && !input.checked)
       {
          $("#all").prop("checked", false);
       }
    }

    else if(name=="language[]")
    {
       if(input.value!="all" && !input.checked)
       {
          $("#all_language").prop("checked", false);
       }
    }

    else if(name=="rating[]")
    {
       if(input.value!="all" && !input.checked)
       {
          $("#all_rating").prop("checked", false);
       }
    }

    
    //return false;

    var url = get_url();
    console.log(url);
    window.location.replace(url);
}

function toggleLayout(layout) {
    $.ajax({
        type : 'POST',
        url : '<?php echo site_url('home/set_layout_to_session'); ?>',
        data : {layout : layout},
        success : function(response){
            location.reload();
        }
    });
}

function showToggle(elem, selector) {
    $('.'+selector).slideToggle(20);
    if($(elem).text() === "<?php echo get_phrase('show_more'); ?>")
    {
        $(elem).text('<?php echo get_phrase('show_less'); ?>');
    }
    else
    {
        $(elem).text('<?php echo get_phrase('show_more'); ?>');
    }
}
</script>

<script type="text/javascript">
    
 $(".clear_all_link").click(function(){

    $('.categories').prop("checked", false);
    $('.prices').prop("checked", false);
    $('.level').prop("checked", false);
    $('.languages').prop("checked", false);
    $('.ratings').prop("checked", false);

 })

</script>
