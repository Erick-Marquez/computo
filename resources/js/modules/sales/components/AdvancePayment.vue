<template>
    <div class="table-responsive">
        <table class="table table-bordered" style="min-width: 600px;">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">Descripción</th>
                    <th scope="col">Tipo de pago</th>
                    <th scope="col">Monto S/.</th>
                    <th scope="col" class="col-1">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(payment, index) in payments"
                    :key="index"
                >
                    <td class="align-middle">Anticipo {{ index + 1 }}</td>
                    <td>
                        <select
                            :value="payment.payment_type_id"
                            class="form-control rounded-pill"
                            disabled
                        >
                            <option
                                v-for="paymentType in paymentTypes"
                                :key="paymentType.id"
                                :value="paymentType.id"
                            >
                                {{ paymentType.description }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input
                            class="form-control rounded-pill"
                            type="number"
                            min="0"
                            step="0.01"
                            :value="payment.amount"
                            disabled
                        >
                    </td>
                    <td class="text-center">
                        <button
                            type="button"
                            class="btn btn-flat"
                            disabled
                        >
                        <i class="text-danger fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr
                    v-for="(newPayment, index) in newPayments"
                    :key="index"
                >
                    <td class="align-middle">Anticipo {{ payments.length + index + 1 }}</td>
                    <td>
                        <select
                            v-model="newPayment.payment_type_id"
                            :class="
                                'form-control rounded-pill' +
                                (errors['newPayments.' + index + '.payment_type_id'] == null
                                ? ''
                                : ' is-invalid')
                            "
                        >
                        <option
                            v-for="paymentType in paymentTypes"
                            :key="paymentType.id"
                            :value="paymentType.id"
                        >
                            {{ paymentType.description }}
                        </option>
                        </select>
                        <div
                            class="invalid-feedback"
                            v-if="errors['newPayments.' + index + '.payment_type_id']"
                        >
                            {{ errors["newPayments." + index + ".payment_type_id"][0] }}
                        </div>
                    </td>
                    <td>
                        <input
                            :class="
                                'form-control rounded-pill' +
                                (errors['newPayments.' + index + '.amount'] == null
                                ? ''
                                : ' is-invalid')
                            "
                            type="number"
                            min="0"
                            step="0.01"
                            v-model="newPayment.amount"
                        >
                        <div
                            class="invalid-feedback"
                            v-if="errors['newPayments.' + index + '.amount']"
                        >
                            {{ errors["newPayments." + index + ".amount"][0] }}
                        </div>
                    </td>
                    <td class="text-center">
                        <button
                            type="button"
                            class="btn btn-flat"
                            @click="deletePayment(index)"
                        >
                        <i class="text-danger fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="button" class="btn btn-md btn-block btn-dark my-2" @click="addPayment()">
        <span><i class="fas fa-plus"></i></span>
        Añadir otro anticipo
    </button>
</template>

<script>
export default {
  props: {
    paymentTypes: Array,
    payments: Array,
    newPayments: Array,
    errors: Object
  },
  methods: {
    addPayment(){

      let temp = {
        payment_type_id: null,
        amount: 0
      }

      this.newPayments.push(temp)
    },
    deletePayment(index) {

      this.newPayments.splice(index, 1);

    },
  },
};
</script>