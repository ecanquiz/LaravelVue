import { shallowMount } from '@vue/test-utils';
import CounterV3 from '../Pages/Tests/CounterV3.vue'

describe('CounterV3.vue', () => {
    it('increments counter', () => {
        const wrapper = shallowMount(CounterV3);

        expect(wrapper.vm.counter).toBe(0);

        wrapper.find('button').trigger('click');

        expect(wrapper.vm.counter).toBe(1);
    })
});
