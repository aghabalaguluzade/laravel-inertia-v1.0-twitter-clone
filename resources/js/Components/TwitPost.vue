<template>

  <div v-for="tweet in tweets.data" :key="tweet.id" class="flex w-full h-auto cursor-pointer hover:bg-lowWhite" :class="{ 'bg-opacity-50' : isOpen }">
    <div class="p-3">
            <img :src="tweet.user.profile_photo_path" class="w-[45px] rounded-full" :alt="tweet.user.name" />
        </div>
        <div class="w-full">
            <div class="text-sm px-2 flex  items-center justify-start gap-2 text-normalWhite mt-2">
                <h3 class="font-bold hover:underline"><Link :href="tweet.user.username">{{ tweet.user.name }}</Link></h3>
                <span class="text-lowsWhite font-light flex-grow"><Link :href="tweet.user.username">@{{ tweet.user.username }}</Link> · {{ formatDateString(tweet.created_at) }}</span>
                <span>
                <svg viewBox="0 0 24 24"
                     class="w-[30px] cursor-pointer rounded-full p-2 fill-lowsWhite  hover:fill-tickBlue  hover:bg-hoverBlue z-100 transition duration-200"
                     aria-hidden="true">
                    <g>
                        <path d="M3 12c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2zm9 2c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm7 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"></path>
                    </g>
                </svg>
            </span>
            </div>
            
            <Link :href="tweetLink(tweet.user.username, tweet.id)">
                <div class="text-sm text-normalWhite">
                    {{ tweet.content }}
                </div>
            </Link>

            <div v-if="tweet.media">
                <div v-for="(item, index) in tweet.media" :key="index" class="pr-3 mt-2">
                    <img :src="item.full_url" class="object-cover border-[1px] border-lowsWhite rounded-lg" alt="post image" />
                </div>
            </div>

            <ul class="flex items-center w-full justify-start gap-10 py-3">
                    
                    <li @click="clickReply(tweet.id, tweet.content, tweet.user.profile_photo_path)" class="flex items-center gap-1 text-sm text-lowsWhite transition duration-200 group fill-lowsWhite hover:fill-tickBlue hover:text-tickBlue cursor-pointer">
                        <span class="p-2 rounded-full group-hover:bg-hoverBlue transition duration-200">
                            <svg viewBox="0 0 24 24" class=" w-[20px]" aria-hidden="true">
                            <g>
                                <path d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z"></path>
                            </g>
                            </svg>
                        </span>
                        {{ tweet.comments_count }}
                    </li>

                <li class="flex items-center gap-1 group text-sm text-lowsWhite transition duration-200 fill-lowsWhite hover:fill-useGreen hover:text-useGreen cursor-pointer">
                   

                    <div tabindex="10"
                         class="cursor-pointer relative group rounded-full p-2 fill-lowsWhite hover:fill-tickBlue  hover:bg-hoverBlue transition duration-200">
                        <svg viewBox="0 0 24 24" class=" w-[20px]" aria-hidden="true">
                            <g>
                                <path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path>
                            </g>
                        </svg>
                        <div class="absolute  opacity-0 shadow-[rgba(222,222,222,0.6)] shadow-[0_0_7px_0] overflow-hidden text-normalWhite rounded-xl text-sm w-64 bg-black z-100 pointer-events-none group-focus:opacity-100 group-focus:pointer-events-auto -bottom-10 transition duration-200 right-0">
                            <div class="flex flex-col">
                                <span @click="" class="py-3 px-2 flex items-center gap-2 hover:bg-lowWhite cursor-pointer">
                                    <svg viewBox="0 0 24 24" class=" w-[20px]" aria-hidden="true">
                                        <g>
                                            <path d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path>
                                        </g>
                                    </svg>
                                  Repost
                                </span>
                                <span class="py-3 px-2 flex items-center gap-2 hover:bg-lowWhite cursor-pointer">
                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-[20px] r-1nao33i r-4qtqp9 r-yyyyoo r-1q142lx r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr"><g><path d="M14.23 2.854c.98-.977 2.56-.977 3.54 0l3.38 3.378c.97.977.97 2.559 0 3.536L9.91 21H3v-6.914L14.23 2.854zm2.12 1.414c-.19-.195-.51-.195-.7 0L5 14.914V19h4.09L19.73 8.354c.2-.196.2-.512 0-.708l-3.38-3.378zM14.75 19l-2 2H21v-2h-6.25z"></path></g></svg>
                                    Quote
                                </span>
                            </div>
                        </div>
                    </div>

                    17
                </li>
                <li class="flex items-center gap-1 group text-sm text-lowsWhite transition duration-200 fill-lowsWhite  hover:fill-myPink hover:text-myPink cursor-pointer" :class="{ 'fill-myPink' : tweet.liked  }">
                    <Link preserve-scroll method="POST" as="button" :href="`/tweets/${tweet.id}/like`"> 
                        <TwitLike></TwitLike>
                    </Link>   
                    {{ tweet.likes_count }}
                </li>                    
                <li class="flex items-center group gap-1 text-sm text-lowsWhite transition duration-200 fill-lowsWhite hover:fill-tickBlue hover:text-tickBlue cursor-pointer">
                    <span class="p-2 rounded-full group-hover:bg-hoverBlue transition duration-200">
                         <svg viewBox="0 0 24 24" class=" w-[20px]" aria-hidden="true">
                            <g>
                                <path d="M8.75 21V3h2v18h-2zM18 21V8.5h2V21h-2zM4 21l.004-10h2L6 21H4zm9.248 0v-7h2v7h-2z"></path>
                            </g>
                        </svg>
                    </span>
                    {{ tweet.tweet_view_count ?? 0 }}
                </li>
                <li class="flex items-center group gap-1 text-sm text-lowsWhite transition duration-200 fill-lowsWhite hover:fill-tickBlue hover:text-tickBlue cursor-pointer">
                    <span class="p-2 rounded-full group-hover:bg-hoverBlue transition duration-200">
                        <svg viewBox="0 0 24 24" class=" w-[20px]" aria-hidden="true">
                            <g>
                                <path d="M12 2.59l5.7 5.7-1.41 1.42L13 6.41V16h-2V6.41l-3.3 3.3-1.41-1.42L12 2.59zM21 15l-.02 3.51c0 1.38-1.12 2.49-2.5 2.49H5.5C4.11 21 3 19.88 3 18.5V15h2v3.5c0 .28.22.5.5.5h12.98c.28 0 .5-.22.5-.5L19 15h2z"></path>
                            </g>
                        </svg>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <div v-if="tweets.next_page_url" ref="scrollIndicator" class="text-center text-gray-400 my-4">
        Yüklənir...
    </div>

    <div v-show="isOpen" class="absolute flex items-center justify-center bg-gray-700 bg-opacity-100 h-12 top-60">
        <TwitReply :selectedTweet="selectedTweet" :isOpen="isOpen"></TwitReply>
    </div>

</template>

<script setup>
    import { defineProps, onMounted, onUnmounted, ref, watch } from 'vue';
    import { format } from 'date-fns';
    import axios from 'axios';
    import debounce from 'lodash/debounce';
    import TwitReply from './TwitReply.vue';
    
    const props = defineProps({
        tweets: Object,
        images : Object
    });

    const isOpen = ref(false);
    const selectedTweet = ref({ id: '', content: '' });
    const tweets = ref(props.tweets);

    const clickReply = (tweetId, tweetContent, tweetImg) => {
        isOpen.value = !isOpen.value;
        selectedTweet.value = {
            id: tweetId,
            content: tweetContent,
            profile_photo_path : tweetImg
        };
    }

    const formatDateString = (dateString) => {
        return format(new Date(dateString), 'MMM d')
    }

    const loadMoreTweets = () => {
            axios.get(tweets.value.next_page_url).then((response) => {
                tweets.value = {
                    ...response.data,
                    data: [...tweets.value.data, ...response.data.data],
                };
            });
    };

    onMounted(() => {
        const handleScroll = debounce(() => {
            const pixelsFromBottom = document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight;

            if (pixelsFromBottom < 200) {
                loadMoreTweets();
            }
        }, 100);

        window.addEventListener('scroll', handleScroll);

        onUnmounted(() => {
            window.removeEventListener('scroll', handleScroll);
        });
    });


    const tweetLink = (user,tweet) => {
        return `${user}/status/${tweet}`
    };

    watch(() => props.tweets, (newTweets) => {
        tweets.value = newTweets;
    });

</script>