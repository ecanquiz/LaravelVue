import { shallowMount } from '@vue/test-utils'
import CounterV2 from '../Pages/Tests/CounterV2.vue'

describe('CounterV2.vue', () => {
    it('increments counter', () => {
        const wrapper = shallowMount(CounterV2);

        expect(wrapper.vm.counter).toBe(0);

        wrapper.find('button').trigger('click');

        expect(wrapper.vm.counter).toBe(1);
    })
});
