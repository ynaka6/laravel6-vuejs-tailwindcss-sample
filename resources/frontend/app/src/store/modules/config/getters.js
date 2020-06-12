const getters = {
    const: state => {
        return state.const;
    },
    businessCategoryOption: state => {
        let option = [];
        if (state.const && state.const.businessCategories) {
            option.push(
                ...state.const.businessCategories.map(v => ({
                    text: v.name,
                    value: v.id
                }))
            );
        }
        return option;
    },
    userProfileGenderOption: state => {
        let option = [];
        if (state.const && state.const.userProfileGenders) {
            option.push(
                ...Object.keys(state.const.userProfileGenders).map(v => ({
                    text: state.const.userProfileGenders[v],
                    value: v
                }))
            );
        }
        return option;
    },
    userProfileStatusOption: state => {
        let option = [];
        if (state.const && state.const.userProfileStatuses) {
            option.push(
                ...Object.keys(state.const.userProfileStatuses).map(v => ({
                    text: state.const.userProfileStatuses[v],
                    value: v
                }))
            );
        }
        return option;
    },
    userProfileSiteProvidors: state => {
        return state.const && state.const.userProfileSiteProvidors
            ? state.const.userProfileSiteProvidors
            : [];
    }
};

export default getters;
