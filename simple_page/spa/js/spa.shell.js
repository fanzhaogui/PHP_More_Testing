spa.shell = (function () {
    var configMap = {
        anchor_schema_map : {
            // 定义给uriAnchor使用的映射，用于验证
            chat : {open : true, close : true}
        },
        main_html : String()
        + '<div class="spa-shell-head">'
            + '<div class="spa-shell-head-logo"></div>'
            + '<div class="spa-shell-head-acct"></div>'
            + '<div class="spa-shell-head-search"></div>'
        + '</div>'
        + '<div class="spa-shell-main">'
            + '<div class="spa-shell-main-nav"></div>'
            + '<div class="spa-shell-main-content"></div>'
        + '</div>'
        + '<div class="spa-shell-foot"></div>'
        + '<div class="spa-shell-chat"></div>'
        + '<div class="spa-shell-modal"></div>',

        chat_extend_time : 1000,
        chat_retract_time : 300,
        chat_extend_height : 450,
        chat_retract_height : 15,
        chat_extend_title : '弹起聊天框',
        chat_retract_title : '已收缩聊天框',
    },
        // 状态等
        stateMap = {
            $container : null,
            anchor_map : {},
            is_chat_retracted : true // 聊天滑块是否关闭
        },
        jqueryMap = {},
        // 事件
        setJquery, toggleChat, onClickChat,
        copyAnchorMap, changeAnchorPart, onHashchange,
        initModule;

    copyAnchorMap = function () {
        return $.extend( true, {}, stateMap.anchor_map );
    };

    changeAnchorPart = function (arg_map) {
        var
        anchor_map_revise = copyAnchorMap(),
        bool_return = true,
        key_name, key_name_dep,

        KEYVAL;
        for (key_name in arg_map) {
            if (arg_map.hasOwnProperty(key_name)) {

                if (key_name.indexOf('_') === 0) {
                    // continue KEYVAL;
                    continue ;
                }
                anchor_map_revise[key_name] = arg_map[key_name];

                key_name_dep = "_" + key_name;

                if (arg_map[key_name_dep]) {
                    anchor_map_revise[key_name_dep] = arg_map[key_name_dep]
                }
                else {
                    delete anchor_map_revise[key_name_dep];
                    delete anchor_map_revise['_s' + key_name_dep];
                }
            }

        }
        try {
            $.uriAnchor.setAnchor(anchor_map_revise);
        } catch (err) {
            $.uriAnchor.setAnchor(stateMap.anchor_map, null, true);
            bool_return = false;
        }
        return bool_return;
    };

    onHashchange = function (event) {

    };

    setJquery = function () {
        var $container = stateMap.$container;
        jqueryMap = {
            $container : $container,
            $chat : $container.find('.spa-shell-chat'),
        };
    };

    // 聊天窗
    toggleChat = function (do_extend, callback) {
        var
            px_chat_ht = jqueryMap.$chat.height(),
            is_open = px_chat_ht == configMap.chat_extend_height,
            is_closed = px_chat_ht == configMap.chat_retract_height,
            is_sliding = !is_open && !is_closed;

        if (is_sliding) { return false; }

        if (do_extend) {
            jqueryMap.$chat.animate(
                {height: configMap.chat_extend_height},
                configMap.chat_extend_time,
                function () {
                    jqueryMap.$chat.attr({title: configMap.chat_extend_title});
                    stateMap.is_chat_retracted = false;

                    if (callback && typeof callback == "function") {
                        callback(jqueryMap.$chat)
                    }
                }
            );
            return true;
        }

        jqueryMap.$chat.animate(
            {height: configMap.chat_retract_height},
            configMap.chat_retract_time,
            function () {
                jqueryMap.$chat.attr({title: configMap.chat_retract_title});
                stateMap.is_chat_retracted = true;
                if (callback && typeof callback == "function") {
                    callback(jqueryMap.$chat)
                }
            }
        );
        return true;
    };

    // 聊天滑块点击
    onClickChat = function (event) {
        if ( toggleChat(stateMap.is_chat_retracted) ) {
            // URL增加锚点
            console.log(stateMap.is_chat_retracted)
            $.uriAnchor.setAnchor({
                chat: (stateMap.is_chat_retracted ? 'open' : 'closed')
            })
        }
        return false;
    };

    initModule = function ($container) {
        stateMap.$container = $container;
        $container.html(configMap.main_html);
        setJquery();

        stateMap.is_chat_retracted = true;
        jqueryMap.$chat.attr(
            {title : configMap.chat_retract_title}
        ).click(onClickChat);

        // teste toggle
        /*setInterval(function () {
            console.log("开... ");
            toggleChat(1);
        }, 3000);
        setInterval(function () {
            console.log("关");
            toggleChat(0);
        }, 5000);*/
    };

    return {initModule: initModule};
}());