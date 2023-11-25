<template>
  <!--begin::Content container-->

  <reach-search :demand-store="demandStore"/>
  <!--end::Form-->
  <!--begin::Toolbar-->
  <base-card-and-table-toolbar
      :total="demandStore.total"
      card-id-name="demand_card_pane"
      table-id-name="demand_table_pane"
  />
  <!--begin::Tab Content-->
  <div class="tab-content">
    <!--begin::Tab pane-->
    <div id="demand_card_pane" class="tab-pane fade show active">
      <!--begin::Row-->
      <loader :is-loading="demandStore.is.loading">
        <div class="row g-6 g-xl-9">
          <!--begin::Col-->
          <div
              class="col-md-4 col-xl-12 col-xxl-4"
              v-for="demand in demandStore.demands"
              :key="demand.id"
          >
            <!--begin::Card-->
            <div class="card">
              <!--begin::Card body-->

              <div class="d-flex align-items-baseline">
                <div class="card-body d-flex flex-center flex-column pt-7 p-3">
                  <!--begin::Avatar-->
                  <div class="symbol symbol-45px symbol-circle mb-5">
                    <img src="/media//avatars/blank.png" alt="image"/>
                  </div>
                  <!--end::Avatar-->
                  <!--begin::Name-->
                  <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold mb-0">
                    {{ demand.man }}
                  </a>
                  <div class="fw-semibold fs-7 text-gray-400 mb-6 mt-1">
                    {{ demand.manPresenter }}
                  </div>


                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                      <span
                          class="
                        border border-gray-300 border-dashed rounded
                        min-w-80px py-3 px-4 mx-2 mb-3
                        fw-semibold text-gray-400 fs-8 text-center
                          "
                      >
                        {{ demandStatus(demand).phrase }}
                      </span>
                  <crud-dropdown
                      @view=""
                      @edit=""
                      @delete=""
                  />

                </div>
                <div class="card-body d-flex flex-center flex-column pt-7 p-3">
                  <!--begin::Avatar-->
                  <div class="symbol symbol-45px symbol-circle mb-5">
                    <img src="/media//avatars/blank.png" alt="image"/>
                  </div>
                  <!--end::Avatar-->
                  <!--begin::Name-->
                  <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bold mb-0">
                    {{ demand.woman }}
                  </a>
                  <div class="fw-semibold fs-7 text-gray-400 mb-6 mt-1">
                    {{ demand.womanPresenter }}
                  </div>


                </div>
              </div>
              <!--end::Card body-->
            </div>
            <!--end::Card-->
          </div>

          <!--end::Col-->
        </div>
      </loader>
      <!--end::Row-->
    </div>
    <!--end::Tab pane-->

    <!--begin::Tab pane-->
    <div id="demand_table_pane" class="tab-pane fade">
      <!--          begin::Card-->
      <loader :is-loading="demandStore.is.loading">
        <div class="card card-flush">
          <!--begin::Card body-->
          <div class="card-body pt-0">
            <!--begin::Table container-->
            <div class="table-responsive">
              <!--begin::Table-->
              <table id="kt_project_users_table"
                     class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                <!--begin::Head-->
                <thead class="fs-7 text-gray-400 text-uppercase">
                </thead>
                <!--end::Head-->
                <!--begin::Body-->
                <tbody class="fs-6">
                <tr
                    v-for="demand in  demandStore.demands"
                    :key="demand.id"
                >
                  <td>
                    <a class="mb-1 text-gray-800 text-hover-primary">
                      {{ demand.man }}
                    </a>
                    <div class="fw-semibold fs-7 text-gray-400 mt-1">
                      {{ demand.manPresenter }}
                    </div>
                  </td>
                  <td>
                    <a class="mb-1 text-gray-800 text-hover-primary">
                      {{ demand.woman }}
                    </a>
                    <div class="fw-semibold fs-7 text-gray-400 mt-1">
                      {{ demand.womanPresenter }}
                    </div>
                  </td>
                  <td>
                           <span
                               class="fs-8 badge badge-light-success fw-bold px-4 py-3"
                               :class="demandStatus(demand).class"
                           >
                          {{ demandStatus(demand).phrase }}
                        </span>
                  </td>
                  <td class="text-end">
                    <crud-dropdown
                        @view=""
                        @edit=""
                        @delete=""

                    />
                  </td>
                </tr>
                </tbody>
                <!--end::Body-->
              </table>
              <!--end::Table-->
            </div>
            <!--end::Table container-->
          </div>
          <!--end::Card body-->
        </div>
      </loader>
      <!--          end::Card-->
    </div>
    <!--end::Tab pane-->

    <!--begin::Pagination-->
    <pagination/>
    <!--end::Pagination-->
  </div>
  <!--end::Tab Content-->
</template>

<script lang="ts">
import {defineComponent} from "vue";
import Pagination from "@/components/widgets/Pagination";
import Loader from "@/components/base/Loader.vue";
import ReachSearch from "@/components/modules/demand/ReachSearch.vue";
import {useDemandStore} from "@/pinia_store/modules/DemandStore";
import BaseCardAndTableToolbar from "@/components/toolbar/BaseCardAndTableToolbar.vue";
import CrudDropdown from "@/components/dropdown/CrudDropdown.vue";

let demandStore: any = ''
let tagStore: any = ''

export default defineComponent({
  name: "demand",
  components: {
    Loader,
    Pagination,
    ReachSearch,
    CrudDropdown,
    BaseCardAndTableToolbar,
  },
  beforeRouteEnter(to, from, next) {
    demandStore = useDemandStore();
    next();
  },
  setup() {

    const demandStatus = (demand) => {
      const classStatus = {
        initiated: 'badge-light-warning',
        talking: 'badge-light-info',
        thinking: 'badge-light-info',
        married: 'badge-light-success'
      }

      return {
        class: classStatus[demand.status],
        phrase: phraseStatus[demand.status]
      }
    }

    return {demandStore, demandStatus}
  }

});
</script>