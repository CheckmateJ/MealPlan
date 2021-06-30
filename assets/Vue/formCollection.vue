<template>
  <div>
    <form method="post">
      <div class="test" v-model="formData = config">
        <div class="form-floating course">
          <input v-once name="course[name]" type="text" required id="course_name"
                 class="form-control course-name text-center" placeholder="Course name" :value="courseName">
          <label for="course_name" style="margin-left: 40px">Course name</label>
        </div>
      </div>
      <div class="course-ingredients-list">
      </div>
      <div class="form-collection">
        <ul class="course-ingredients">
          <li class="list-of-fields" v-for="(courseIngredients, index) in formData" :key="index">
            <div class="form-fields">
              <select v-bind:class="`form-control form_ingredient_select_${index} form-ingredient form-select`"
                      v-bind:id="`course_courseIngredient_${index}_ingredient`"
                      v-bind:name="`course[courseIngredient][${index}][ingredient]`"
                      v-bind:value="courseIngredients.ingredient.id"
                      @change="selectedChange(index)"
                      required="required">
                <option>--Ingredient--</option>
                <option
                    v-for="(ingredient, key) in ingredients"
                    v-bind:class="`ingredient_${ingredient.id}`"
                    v-model='forms[key] = ingredient'
                    v-bind:value="ingredient.id"
                >{{ ingredient.name }}
                </option>
              </select>
              <input v-bind:class="`form-control form-amount form-amount-${index}`"
                     v-bind:id="`course_courseIngredient_${index}_amount`"
                     v-bind:name="`course[courseIngredient][${index}][amount]`"
                     type="number" placeholder="amount"
                     required="required"
                     v-model="courseIngredients.amount"
              />
              <select v-bind:class="`form-control form-unit-select`"
                      v-bind:id="`course_courseIngredient_${index}_unit`"
                      v-bind:name="`course[courseIngredient][${index}][unit]`"
                      v-model="courseIngredients.unit"
                      required="required"
              >
                <option
                    v-model="courseIngredients.ingredient.availableUnits"
                    v-for="unit in courseIngredients.ingredient.availableUnits">{{ unit }}
                </option>
              </select>
              <button @click="deleteCourseIngredient(index)" :data-id="index" type="button"
                      v-bind:class="`btn btn-danger delete-button delete-button-${index}`">
                <svg id="minus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-dash-lg"
                     viewBox="0 0 16 16">
                  <path d="M0 8a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H1a1 1 0 0 1-1-1z"/>
                </svg>
              </button>
            </div>
          </li>
        </ul>
        <div class="action-button">
          <button type="button" @click="newCourseIngredient" class="add_item_link add-button  btn btn-primary "
                  data-collection-holder-class="courseIngredient">
            <svg id="add" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                 class="bi bi-plus-lg"
                 viewBox="0 0 16 16">
              <path d="M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z"/>
            </svg>
          </button>
        </div>
      </div>
      <div>
        <button type="submit" class="save-button btn btn-success" name="course[save]">Save</button>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ['courseName', 'config', 'ingredients'],
  data() {
    return {
      selected: '--Ingredient--',
      formData: [],
      availableUnits: [],
      forms: [],
    }
  },
  methods: {
    selectedChange(index) {
      let selectedValue = document.querySelector(`.form_ingredient_select_${index}`).value;
      for (let i = 0; i < this.ingredients.length; i++) {
        if (this.ingredients[i].id === parseInt(selectedValue)) {
          this.formData[index].ingredient = this.ingredients[i]
        }
      }
    },
    newCourseIngredient() {
      this.formData.push({amount: null, ingredient: {}, unit: ''})
    },
    deleteCourseIngredient(index) {
      this.formData = this.formData.splice(index, 1);
    },
  }
}
</script>