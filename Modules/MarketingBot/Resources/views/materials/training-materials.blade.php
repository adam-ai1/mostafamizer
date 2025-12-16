@extends('layouts.user_master')
@section('page_title', __('Training Materials'))

@section('content')
    <main class="w-[68.9%] 5xl:w-[85.9%] pt-[56px] dark:bg-[#292929] flex flex-col flex-1 font-Figtree border-l dark:border-[#474746] border-color-DF">
        <div class="xl:flex h-full subscription-main bg-color-F6 dark:bg-color-29">
            <!-- Start Sidebar -->
            @include('marketingbot::layouts.sidebar')

            <div
				class="w-full max-w-[1280px] mx-auto px-5 sidebar-scrollbar xl:h-[calc(100vh-56px)] xl:overflow-auto pt-[21px] sm:pt-6 pb-[56px]"
					>
                <div
                    class="flex flex-col gap-4 2xl:flex-row 2xl:items-center 2xl:justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1
                                class="text-color-14 text-24 font-semibold font-RedHat dark:text-white wrap-anywhere"
                            >
                                {{ __('Training Materials') }}
                            </h1>
                            <p
                                class="text-color-89 text-sm font-medium wrap-anywhere mt-1"
                            >
                                {{ __('Take advantage of the power of AI to train your bots super fast.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Start KPI Cards -->
                <section
                    class="grid grid-cols-1 sm:grid-cols-2 5xl:grid-cols-3 gap-6 mb-8">
                    <div
                        data-target="modal1"
                        class="openModalBtn cursor-pointer w-full bg-white dark:bg-color-3A py-[27px] px-8 rounded-xl lg:cursor-pointer"
                    >
                        <div
                            class="mb-[14px] flex items-center justify-center h-[48px] w-[48px] rounded-lg border border-color-DF bg-color-F6 dark:bg-color-47 dark:border-none overflow-hidden"
                        >
                            <svg
                                width="19"
                                height="27"
                                viewBox="0 0 19 27"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0.5 22.9016V0.5H13.1787L18.4606 5.78191V22.9016H0.5Z"
                                    fill="white"
                                    stroke="#474746"
                                ></path>
                                <path
                                    d="M13.3867 5.5748H18.9615L13.3867 0V5.5748Z"
                                    fill="#474746"
                                ></path>
                                <path
                                    d="M15.9051 7.87402H3.05469V8.78741H15.9051V7.87402Z"
                                    fill="#474746"
                                ></path>
                                <path
                                    d="M15.9051 11.6851H3.05469V12.5984H15.9051V11.6851Z"
                                    fill="#474746"
                                ></path>
                                <path
                                    d="M15.9051 15.5273H3.05469V16.4407H15.9051V15.5273Z"
                                    fill="#474746"
                                ></path>
                                <path
                                    d="M15.9051 19.3384H3.05469V20.2518H15.9051V19.3384Z"
                                    fill="#474746"
                                ></path>
                                <path
                                    d="M6.74013 20.0316V26.2678H12.2204V20.0316H14.4567L9.48028 15.0552L4.50391 20.0316H6.74013Z"
                                    fill="#FF774B"
                                ></path>
                            </svg>
                        </div>
                        <p class="text-dark-1 dark:text-white font-medium text-lg">
                            {{ __('File Upload') }}
                        </p>
                        <p class="text-color-89 font-medium text-[13px]">
                            {{ __('Train your bot from files.') }}
                        </p>
                    </div>

                    <!-- Start Modal  -->
                    <div
                        id="modal1"
                        class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4"
                    >
                        <!-- Modal Box -->
                        <div
                            class="modalBox max-w-4xl min-w-[300px] bg-white dark:bg-color-3A rounded-xl p-5 sm:p-7 relative transform transition-all duration-300 scale-0 opacity-0"
                        >
                            <!-- Close Button -->
                            <button type="button"
                                class="closeModalBtn invisible absolute top-2 right-3 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200"
                            >
                                ✖
                            </button>

                            <!-- Modal Content -->
                            <form id="upload-files">
                            @csrf
                            <div class="relative">
                                <input
                                    type="file"
                                    id="fileUpload"
                                    accept="file/*"
                                    class="hidden"
                                    name="file[]"
                                />
                                <label
                                    for="fileUpload"
                                    class="flex items-center justify-center w-full border border-dashed rounded-xl p-5 cursor-pointer dark:bg-color-33 bg-[#f7f9ff] border-color-DF dark:border-color-89"
                                >
                                    <div class="text-center flex flex-col items-center">
                                        <span class="mb-2">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="50"
                                                height="50"
                                                x="0"
                                                y="0"
                                                viewBox="0 0 286.036 286.036"
                                                xml:space="preserve"
                                            >
                                                <g>
                                                    <path
                                                        d="M231.641 113.009c-3.915-40.789-37.875-72.792-79.684-72.792-32.351 0-60.053 19.201-72.819 46.752-3.844-1.225-7.849-2.056-12.095-2.056-22.214 0-40.226 18.021-40.226 40.226 0 4.416.885 8.591 2.199 12.551C11.737 147.765 0 166.26 0 187.696c0 32.092 26.013 58.105 58.105 58.105v.018h160.896v-.018c37.044 0 67.035-30.009 67.035-67.044 0-32.682-23.421-59.83-54.395-65.748zm-54.833 51.463h-15.912v35.864c0 4.943-3.987 8.957-8.939 8.957h-17.878c-4.934 0-8.939-4.014-8.939-8.957v-35.864h-15.921c-9.708 0-13.668-6.481-8.823-14.383l33.799-33.316c6.624-6.615 10.816-6.838 17.646 0l33.799 33.316c4.863 7.911.876 14.383-8.832 14.383z"
                                                        fill="#DDDDDD"
                                                        data-original="#39b29d"
                                                        opacity="1"
                                                    ></path>
                                                </g>
                                            </svg>
                                        </span>
                                        <h5
                                            class="text-center text-lg text-color-14 dark:text-white font-medium mb-0.5"
                                        >
                                            {{ __("Click or drag file to this area to upload") }}
                                        </h5>
                                        <p class="text-center text-sm text-color-89 font-medium">
                                            {{ __("Supported formats: PDF, DOC, DOCX, TXT files :x MB max", ["x" => preference('file_size')]) }}
                                        </p>
                                    </div>
                                </label>
                            </div>
                            <div class="upload-files hidden">
                                
                                <div class="mt-7 pe-2 max-h-[180px] overflow-y-auto" id="upload-files-list">
                                    <div class="mb-2 flex items-center justify-between border border-color-F3 dark:border-color-47 rounded-lg py-1 px-2">
                                        <div class="flex items-center">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xml:space="preserve"
                                                viewBox="0 0 56 56"
                                                class="flex-shrink-0 w-8">

                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        fill="#E9E9E0"
                                                        d="M36.985 0H7.963C7.155 0 6.5.655 6.5 1.926V55c0 .345.655 1 1.463 1h40.074c.808 0 1.463-.655 1.463-1V12.978c0-.696-.093-.92-.257-1.085L37.607.257A.88.88 0 0 0 36.985 0"
                                                    ></path>
                                                    <path
                                                        fill="#D9D7CA"
                                                        d="M37.5.151V12h11.849z"
                                                    ></path>
                                                    <path
                                                        fill="#F36FA0"
                                                        d="M48.037 56H7.963A1.463 1.463 0 0 1 6.5 54.537V39h43v15.537c0 .808-.655 1.463-1.463 1.463"
                                                    ></path>
                                                    <g fill="#FFF">
                                                        <path
                                                            d="M21.58 51.975a3.7 3.7 0 0 1-1.271.82 4.2 4.2 0 0 1-1.531.273q-.903 0-1.661-.328c-.758-.328-.948-.542-1.326-.971q-.568-.643-.889-1.613-.321-.971-.321-2.242c0-1.271.107-1.593.321-2.235q.32-.964.889-1.606a3.8 3.8 0 0 1 1.333-.978 4.1 4.1 0 0 1 1.654-.335q.82 0 1.531.273.71.274 1.271.82l-1.135 1.012a2.07 2.07 0 0 0-1.627-.752q-.506 0-.964.191a2.07 2.07 0 0 0-.82.649q-.363.458-.567 1.183c-.204.725-.21 1.075-.219 1.777q.014 1.026.212 1.75t.547 1.183c.349.459.497.528.793.67q.444.213.937.212c.493-.001.636-.06.923-.178s.549-.31.786-.574zM29.633 50.238q0 .546-.226 1.06c-.226.514-.362.643-.636.902s-.611.467-1.012.622a3.8 3.8 0 0 1-1.367.232q-.328 0-.677-.034c-.349-.034-.467-.062-.704-.116a3.7 3.7 0 0 1-.677-.226 2.2 2.2 0 0 1-.554-.349l.287-1.176q.19.11.485.212.294.102.608.191t.629.144q.313.054.588.055.834 0 1.278-.39t.444-1.155q0-.465-.314-.793-.315-.328-.786-.595c-.471-.267-.654-.355-1.019-.533a6 6 0 0 1-1.025-.629 3.3 3.3 0 0 1-.793-.854q-.314-.492-.314-1.23 0-.67.246-1.189c.246-.519.385-.641.663-.882q.417-.362.971-.554c.554-.192.759-.191 1.169-.191q.629 0 1.271.116t1.039.376a13 13 0 0 1-.191.39l-.205.396q-.096.185-.164.308a1 1 0 0 1-.082.137q-.082-.04-.185-.109c-.103-.069-.167-.091-.294-.137a2 2 0 0 0-.506-.096 5 5 0 0 0-.807.014q-.274.028-.52.157c-.246.129-.31.193-.438.321a1.5 1.5 0 0 0-.301.431 1.1 1.1 0 0 0-.109.458q0 .546.314.882t.779.588q.465.254 1.012.492.546.24 1.019.581c.473.341.576.513.786.854q.319.513.318 1.319M34.035 53.055l-3.131-10.131h1.873l2.338 8.695 2.475-8.695h1.859l-3.281 10.131z"
                                                        ></path>
                                                    </g>
                                                    <path
                                                        fill="#C8BDB8"
                                                        d="M23.5 16v-4h-12v22h33V16zm-10-2h8v2h-8zm0 4h8v2h-8zm0 4h8v2h-8zm0 4h8v2h-8zm8 6h-8v-2h8zm21 0h-19v-2h19zm0-4h-19v-2h19zm0-4h-19v-2h19zm-19-4v-2h19v2z"
                                                    ></path>
                                                </g>
                                            </svg>
                                            <div class="ms-2">
                                                <h6 class="text-left text-sm text-dark-1 dark:text-white font-medium text-nowrap file_name"></h6>
                                                <p class="text-left text-xs text-color-89 font-medium file_size"></p>
                                            </div>
                                        </div>
                                        <button type="button" class="text-red-500 mr-2">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                viewBox="0 0 16 16"
                                                fill="none"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M5.32812 1.99967C5.32812 1.63148 5.6266 1.33301 5.99479 1.33301H9.99479C10.363 1.33301 10.6615 1.63148 10.6615 1.99967C10.6615 2.36786 10.363 2.66634 9.99479 2.66634H5.99479C5.6266 2.66634 5.32812 2.36786 5.32812 1.99967ZM3.32295 3.33301H1.99479C1.6266 3.33301 1.32812 3.63148 1.32812 3.99967C1.32812 4.36786 1.6266 4.66634 1.99479 4.66634H2.70442L3.13222 11.0833C3.16579 11.5869 3.19356 12.0037 3.24337 12.3429C3.29523 12.6961 3.37749 13.0189 3.54885 13.3197C3.81561 13.7879 4.21798 14.1644 4.70294 14.3994C5.01447 14.5504 5.34199 14.611 5.69785 14.6392C6.03965 14.6664 6.45734 14.6664 6.96208 14.6663H9.0275C9.53224 14.6664 9.94994 14.6664 10.2917 14.6392C10.6476 14.611 10.9751 14.5504 11.2866 14.3994C11.7716 14.1644 12.174 13.7879 12.4407 13.3197C12.6121 13.0189 12.6944 12.6961 12.7462 12.3429C12.796 12.0037 12.8238 11.5869 12.8574 11.0832L13.2852 4.66634H13.9948C14.363 4.66634 14.6615 4.36786 14.6615 3.99967C14.6615 3.63148 14.363 3.33301 13.9948 3.33301H12.6666C12.6627 3.33297 12.6588 3.33297 12.655 3.33301H3.33462C3.33074 3.33297 3.32685 3.33297 3.32295 3.33301ZM11.9489 4.66634H4.04072L4.46084 10.9682C4.49662 11.5049 4.52135 11.8686 4.56256 12.1492C4.60259 12.4218 4.65149 12.5616 4.70738 12.6597C4.84076 12.8938 5.04194 13.082 5.28442 13.1995C5.38602 13.2488 5.5287 13.2883 5.80336 13.3101C6.08614 13.3325 6.45069 13.333 6.98856 13.333H9.00102C9.53889 13.333 9.90344 13.3325 10.1862 13.3101C10.4609 13.2883 10.6036 13.2488 10.7052 13.1995C10.9476 13.082 11.1488 12.8938 11.2822 12.6597C11.3381 12.5616 11.387 12.4218 11.427 12.1492C11.4682 11.8686 11.493 11.5049 11.5287 10.9682L11.9489 4.66634ZM6.66146 6.33301C7.02965 6.33301 7.32812 6.63148 7.32812 6.99967V10.333C7.32812 10.7012 7.02965 10.9997 6.66146 10.9997C6.29327 10.9997 5.99479 10.7012 5.99479 10.333V6.99967C5.99479 6.63148 6.29327 6.33301 6.66146 6.33301ZM9.32812 6.33301C9.69632 6.33301 9.99479 6.63148 9.99479 6.99967V10.333C9.99479 10.7012 9.69632 10.9997 9.32812 10.9997C8.95994 10.9997 8.66146 10.7012 8.66146 10.333V6.99967C8.66146 6.63148 8.95994 6.33301 9.32812 6.33301Z"
                                                    fill="currentColor"
                                                ></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-3 flex justify-end gap-3">
                                    <button type="button"
                                        class="closeModalBtn flex items-center rounded-lg text-[15px] text-center bg-color-14 hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                                    >
                                        <span>{{ __('Cancel') }}</span>
                                    </button>
                                    <button
                                        type="submit"
                                        id="upload-materials"
                                        data-url="{{ route('user.marketing-bot.campaigns.train', ['id' => $campaign->id]) }}" data-type="file"
                                        class="flex items-center rounded-lg text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                                    >
                                        <svg class="w-5 h-5 animate-spin text-white hidden loader-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>

                                        <span class="mx-2"> {{ __('Add files') }}</span>
                                    </button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>
                    <!-- End Modal  -->

                    <div
                        data-target="modal2"
                        class="openModalBtn website-url-modal cursor-pointer w-full bg-white dark:bg-color-3A py-[27px] px-8 rounded-xl lg:cursor-pointer"
                    >
                        <div
                            class="mb-[14px] flex items-center justify-center h-[48px] w-[48px] rounded-lg border text-color-47 dark:text-white border-color-DF bg-color-F6 dark:bg-color-47 dark:border-none overflow-hidden"
                        >
                            <svg
                                width="21"
                                height="25"
                                viewBox="0 0 21 25"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M10.7703 19.0864H9.66797V23.2754H10.7703V19.0864Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M19.3695 23.1182H1.07031V24.2205H19.3695V23.1182Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M10.202 25.008C10.95 25.008 11.5563 24.4016 11.5563 23.6536C11.5563 22.9057 10.95 22.2993 10.202 22.2993C9.45401 22.2993 8.84766 22.9057 8.84766 23.6536C8.84766 24.4016 9.45401 25.008 10.202 25.008Z"
                                    fill="#FF774B"
                                ></path>
                                <path
                                    d="M10.2013 19.9685C15.5937 19.9685 19.9651 15.5971 19.9651 10.2047C19.9651 4.81231 15.5937 0.440918 10.2013 0.440918C4.80889 0.440918 0.4375 4.81231 0.4375 10.2047C0.4375 15.5971 4.80889 19.9685 10.2013 19.9685Z"
                                    fill="white"
                                ></path>
                                <path
                                    d="M10.2047 0C4.56693 0 0 4.59843 0 10.2047C0 15.8425 4.59843 20.4095 10.2047 20.4095C15.8425 20.4095 20.4095 15.811 20.4095 10.2047C20.4095 4.59843 15.8425 0 10.2047 0ZM12.9449 14.3622C13.0709 13.1969 13.1654 11.9055 13.1654 10.6457H16.0315C15.9685 12.3465 15.6535 13.9213 15.1181 15.2441C14.4252 14.8976 13.7008 14.5827 12.9449 14.3622ZM14.7402 16.063C13.9528 17.6063 12.8819 18.7402 11.6535 19.2756C12.1575 18.3307 12.5669 16.9134 12.8189 15.2756C13.5118 15.4646 14.1417 15.7165 14.7402 16.063ZM5.29134 15.2756C4.75591 13.9213 4.40945 12.3465 4.37795 10.6772H7.24409C7.24409 11.937 7.33858 13.2283 7.46457 14.3937C6.70866 14.5827 5.98425 14.8976 5.29134 15.2756ZM7.59055 15.2441C7.84252 16.9134 8.22047 18.3307 8.75591 19.2441C7.52756 18.7402 6.4252 17.5748 5.66929 16.0315C6.26772 15.7165 6.89764 15.4646 7.59055 15.2441ZM7.46457 6.07874C7.33858 7.24409 7.24409 8.53543 7.24409 9.79528H4.37795C4.44094 8.09449 4.75591 6.51968 5.29134 5.19685C5.98425 5.54331 6.70866 5.85827 7.46457 6.07874ZM5.66929 4.37795C6.45669 2.83465 7.52756 1.70079 8.75591 1.16535C8.25197 2.11024 7.84252 3.52756 7.59055 5.16535C6.89764 4.97638 6.26772 4.72441 5.66929 4.37795ZM8.34646 6.26772C8.94488 6.3937 9.5748 6.45669 10.2047 6.45669C10.8346 6.45669 11.4646 6.3937 12.063 6.26772C12.189 7.30709 12.252 8.50394 12.2835 9.79528H8.12598C8.12598 8.50394 8.22047 7.30709 8.34646 6.26772ZM8.12598 10.6457H12.315C12.315 11.937 12.2205 13.1024 12.0945 14.1732C11.4646 14.0787 10.8346 14.0157 10.2047 14.0157C9.5748 14.0157 8.94488 14.0787 8.34646 14.2047C8.22047 13.1339 8.12598 11.937 8.12598 10.6457ZM13.1654 9.79528C13.1654 8.53543 13.0709 7.24409 12.9449 6.07874C13.7008 5.85827 14.4567 5.5748 15.1181 5.19685C15.6535 6.55118 16 8.12599 16.0315 9.79528H13.1654ZM12.8189 5.19685C12.5669 3.52756 12.189 2.11024 11.6535 1.19685C12.8819 1.70079 13.9843 2.83465 14.7402 4.40945C14.1417 4.72441 13.5118 4.97638 12.8189 5.19685ZM13.7953 1.6063C14.7402 2.01575 15.622 2.55118 16.378 3.2126C16.0945 3.46457 15.811 3.68504 15.4961 3.90551C15.0236 3.02362 14.4567 2.23622 13.7953 1.6063ZM11.9685 5.38583C11.4016 5.51181 10.8032 5.5748 10.2047 5.5748C9.6063 5.5748 9.00787 5.51181 8.44095 5.41732C8.88189 2.58268 9.6063 0.913386 10.2047 0.913386C10.7717 0.88189 11.5276 2.55118 11.9685 5.38583ZM4.91339 3.90551C4.59843 3.68504 4.31496 3.46457 4.0315 3.2126C4.7874 2.55118 5.66929 1.98425 6.61417 1.6063C5.95276 2.23622 5.38583 3.02362 4.91339 3.90551ZM4.53543 4.72441C3.90551 6.20472 3.52756 7.93701 3.49606 9.79528H0.88189C0.976378 7.49606 1.92126 5.41732 3.40158 3.84252C3.74803 4.15748 4.15748 4.44094 4.53543 4.72441ZM3.49606 10.6457C3.55906 12.5039 3.93701 14.2362 4.53543 15.7165C4.12598 16 3.74803 16.2835 3.40158 16.5984C1.92126 15.0236 0.976378 12.9449 0.88189 10.6457H3.49606ZM4.91339 16.5354C5.38583 17.4488 5.95276 18.2362 6.58268 18.8661C5.63779 18.4567 4.75591 17.9213 4 17.2598C4.31496 16.9764 4.59843 16.7244 4.91339 16.5354ZM8.44095 15.0551C9.00787 14.9606 9.6063 14.8976 10.2047 14.8976C10.8032 14.8976 11.4016 14.9606 11.9685 15.0551C11.5276 17.8898 10.8032 19.5591 10.2047 19.5591C9.6378 19.5591 8.88189 17.8898 8.44095 15.0551ZM15.4961 16.5354C15.811 16.7559 16.0945 16.9764 16.378 17.2283C15.622 17.8898 14.7402 18.4567 13.7953 18.8346C14.4567 18.2047 15.0236 17.4173 15.4961 16.5354ZM15.874 15.7165C16.5039 14.2362 16.8819 12.5039 16.9134 10.6457H19.5276C19.4331 12.9449 18.4882 15.0236 17.0079 16.5984C16.6614 16.2835 16.252 16 15.874 15.7165ZM19.5276 9.79528H16.9134C16.8504 7.93701 16.4724 6.20472 15.874 4.72441C16.2835 4.44094 16.6614 4.15748 17.0079 3.84252C18.4882 5.41732 19.4331 7.49606 19.5276 9.79528Z"
                                    fill="#474746"
                                ></path>
                            </svg>
                        </div>
                        <p class="text-dark-1 dark:text-white font-medium text-lg">
                            {{ __('Website URL') }}
                        </p>
                        <p class="text-color-89 font-medium text-[13px]">
                            
                        </p>
                    </div>

                    <!-- Start Modal  -->
                    <div
                        id="modal2"
                        class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4"
                    >
                        <!-- Modal Box -->
                        <div
                            class="modalBox max-w-[600px] min-w-[300px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0"
                        >
                            <form class="px-7" id="fetch-url-form" data-url="{{ route('user.marketing-bot.campaigns.fetch-url') }}">
                                @csrf
                                <h5
                                    class="text-lg text-color-14 dark:text-white text-left font-medium mb-0.5"
                                >
                                    {{ __('Enter website link') }}
                                </h5>
                                <p class="text-xs text-color-89 text-left font-medium mb-5">
                                    {{ __('Enter or paste the site URL in the input below.') }}
                                </p>
                                <div class="relative z-5 w-full">
                                    <input
                                        type="url"
                                        required
                                        name="url"
                                        placeholder="{{ __('Enter link here..') }}"
                                        class="form-control h-[44px] p-2.5 dark:bg-color-33 dark:border-color-47 text-sm font-normal focus:outline-none active:outline-none hover:border-gray-1 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 dark:text-white max-h-[188px] w-full bg-color-F6 rounded-xl border border-color-DF text-color-89 mb-1.5 px-4"
                                    />
                                </div>
                                <p class="text-color-89 text-xs text-left mb-4">
                                    * {{ __('By sharing your URL, you confirm you have the necessary rights to share its content.') }}
                                </p>
                                <button
                                    type="submit"
                                    class="fetch-url flex items-center gap-2 py-[11px] rounded-lg text-white hover:opacity-90 transition-opacity overflow-hidden disabled:opacity-75 flex-shrink-0 h-[40px] bg-color-14 dark:bg-white dark:text-color-14 font-semibold text-xs px-6"
                                >
                                    <svg class="w-5 h-5 animate-spin text-white hidden loader-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>

                                    <span class="text-center w-full"> {{ __('Fetch URL') }} </span>
                                </button>
                            </form>
                            <div class="hidden fetch-content">
                                <div class="px-7">
                                    <h5
                                        class="text-15 text-color-14 dark:text-white text-left font-medium mt-6"
                                    >
                                    {{ __('Fetched Content') }}
                                        
                                    </h5>
                                    <p class="text-xs text-color-89 text-left font-medium">
                                        {{ __('We found some links on this page you might want to add:') }}
                                        
                                    </p>
                                </div>
                                <div
                                    class="bg-color-DF dark:bg-color-89 w-full h-[1px] mt-4 mb-3"
                                ></div>
                                <div class="max-h-[172px] overflow-auto" id="fetched-links-list"></div>
                                
                                <div class="bg-color-DF dark:bg-color-89 w-full h-[1px] mb-4"></div>

                                <div class="text-left px-7">
                                    <p class="text-color-89 text-xs">
                                        <span class="text-color-14 dark:text-white font-medium current-count"
                                            >0</span
                                        >
                                        {{ __('out of') }}
                                        <span class="text-color-14 dark:text-white font-medium total-count"
                                            >0</span
                                        >
                                        {{ __('links selected') }}
                                    </p>
                                    <div class="flex justify-between items-center mt-2">
                                        <div class="flex items-center">
                                            <input
                                                id="url-checkbox-all"
                                                type="checkbox"
                                                class="me-2 accent-purple border border-gray-1 cursor-pointer"/>

                                            <label
                                                for="url-checkbox-all"
                                                class="text-sm text-color-14 dark:text-white cursor-pointer select-none"
                                                >{{ __('Select All') }}</label
                                            >
                                        </div>
                                        <div>
                                            <button type="button" id="training-materials" data-url="{{ route('user.marketing-bot.campaigns.train', ['id' => $campaign->id]) }}" data-type="url"
                                                class="flex items-center rounded-lg text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                                            >
                                                <span>{{ __('Add Selected') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal  -->

                    <div
                        data-target="modal3"
                        class="openModalBtn cursor-pointer w-full bg-white dark:bg-color-3A py-[27px] px-8 rounded-xl lg:cursor-pointer"
                    >
                        <div
                            class="mb-[14px] flex items-center justify-center h-[48px] w-[48px] text-color-14 dark:text-white rounded-lg border border-color-DF bg-color-F6 dark:bg-color-47 dark:border-none overflow-hidden">
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M6.18508 8.90923C6.66009 8.90923 7.04874 8.52058 7.04874 8.04557V3.72731H8.77604C9.25105 3.72731 9.6397 3.33866 9.6397 2.86365C9.6397 2.38864 9.25105 2 8.77604 2H3.59412C3.11911 2 2.73047 2.38864 2.73047 2.86365C2.73047 3.33866 3.11911 3.72731 3.59412 3.72731H5.32143V8.04557C5.32143 8.52058 5.71007 8.90923 6.18508 8.90923Z"
                                    fill="#FF774B"
                                ></path>
                                <path
                                    d="M22.59 2H13.9535C13.4785 2 13.0898 2.38864 13.0898 2.86365C13.0898 3.33866 13.4785 3.72731 13.9535 3.72731H22.59C23.065 3.72731 23.4537 3.33866 23.4537 2.86365C23.4537 2.38864 23.065 2 22.59 2Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M22.59 6.31836H13.9535C13.4785 6.31836 13.0898 6.707 13.0898 7.18201C13.0898 7.65702 13.4785 8.04567 13.9535 8.04567H22.59C23.065 8.04567 23.4537 7.65702 23.4537 7.18201C23.4537 6.707 23.065 6.31836 22.59 6.31836Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M22.5913 10.6372H1.86365C1.38864 10.6372 1 11.0259 1 11.5009C1 11.9759 1.38864 12.3645 1.86365 12.3645H22.5913C23.0663 12.3645 23.455 11.9759 23.455 11.5009C23.455 11.0259 23.0663 10.6372 22.5913 10.6372Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M22.5913 14.9551H1.86365C1.38864 14.9551 1 15.3437 1 15.8187C1 16.2937 1.38864 16.6824 1.86365 16.6824H22.5913C23.0663 16.6824 23.455 16.2937 23.455 15.8187C23.455 15.3437 23.0663 14.9551 22.5913 14.9551Z"
                                    fill="currentColor"
                                ></path>
                                <path
                                    d="M22.5913 19.2725H1.86365C1.38864 19.2725 1 19.6611 1 20.1361C1 20.6111 1.38864 20.9998 1.86365 20.9998H22.5913C23.0663 20.9998 23.455 20.6111 23.455 20.1361C23.455 19.6611 23.0663 19.2725 22.5913 19.2725Z"
                                    fill="currentColor"
                                ></path>
                            </svg>
                        </div>
                        <p class="text-color-14 dark:text-white font-medium text-lg">
                            {{ __('Plain Text') }}
                        </p>
                        <p class="text-color-89 font-medium text-[13px]">
                            {{ __('Train from your input text') }}
                        </p>
                    </div>

                    <!-- Start Modal  -->
                    <div
                        id="modal3"
                        class="sweet-modal fixed inset-0 hidden bg-color-14/50 backdrop-blur-[4px] flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 p-4"
                    >
                        <!-- Modal Box -->
                        <div
                            class="modalBox max-w-[600px] min-w-[300px] bg-white dark:bg-color-3A rounded-xl py-7 relative transform transition-all duration-300 scale-0 opacity-0"
                        >
                            <form class="px-7" id="plain-text-form">
                                <h5
                                    class="text-lg text-color-14 dark:text-white text-left font-medium mb-0.5"
                                >
                                    {{ __('Enter Text') }}
                                </h5>
                                <p class="text-xs text-color-89 text-left font-medium mb-5">
                                    {{ __('Write down or paste your text in the input below.') }}
                                </p>
                                <div class="relative z-5 w-full">
                                    <div>
                                        <textarea
                                            required
                                            rows="8"
                                            cols="50"
                                            name="text"
                                            placeholder="Enter here.."
                                            class="form-control max-h-[200px] p-3 dark:bg-color-33 dark:border-color-47 text-sm font-normal focus:outline-none active:outline-none hover:border-gray-1 dark:hover:border-color-89 transition ease-out duration-200 placeholder:text-color-89 dark:text-white w-full bg-color-F6 rounded-xl border border-color-DF text-color-89 mb-5"
                                    ></textarea>
                                    </div>
                                    
                                </div>
                                <button type="submit"
                                    data-url="{{ route('user.marketing-bot.campaigns.train', ['id' => $campaign->id]) }}" data-type="text"
                                    class="flex items-center rounded-[6px] text-[15px] text-center magic-bg hover:shadow-lg text-white px-5 py-2.5 font-medium hover:opacity-90 transition-all duration-200"
                                >
                                    <svg class="w-5 h-5 animate-spin text-white loader-icon hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="mx-2">{{ __('Add for training') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- End Modal  -->
                </section>
                <!-- End KPI Cards -->

                <!-- Start Table -->

                <!-- Filters and Search -->
                <div class="bg-white dark:bg-color-3A border border-color-89/10 rounded-xl px-4 sm:px-6 py-4 mb-4 transition-colors">
                    <!-- Actual Filters and Search (Visible immediately) -->
                    <div class="filters-content">
                        <div class="flex flex-col flex-wrap lg:flex-row lg:items-center lg:justify-between gap-4">
                            <!-- Left Section -->
                            <div class="flex flex-col lg:flex-row sm:items-center gap-4 w-full lg:w-auto">
                                <!-- Search -->
                                <div class="relative w-full lg:w-auto flex-1">
                                    <svg
                                        class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-color-14 dark:text-white pointer-events-none"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                        ></path>
                                    </svg>
                                    <input
                                        onkeyup="searchTrainingMaterials(this)"
                                        name="search"
                                        type="text"
                                        id="material-search"
                                        placeholder="{{ __('Search campaigns...') }}"
                                        class="pl-10 pr-4 py-2.5 text-sm rounded-lg bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 placeholder-gray-400 hover:border-color-89 dark:hover:border-color-89 placeholder:text-color-89 text-color-14 dark:text-white focus:outline-none w-full lg:w-64 transition"
                                    />
                                </div>

                                <!-- Status Filter -->
                                <div class="relative w-full lg:w-[100px] custom-select">
                                    <button type="button"
                                        class="select-btn w-full flex justify-between items-center px-4 py-2.5 text-sm rounded-lg border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition">
                                        <span class="selected-option filter-status">{{ __('All') }}</span>
                                        <svg
                                            class="w-4 h-4 text-gray-400 dark:text-gray-300"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19 9l-7 7-7-7"
                                            />
                                        </svg>
                                    </button>

                                    <ul
                                        class="select-menu absolute hidden mt-1 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg shadow-lg overflow-hidden z-20">
                                        <li onclick="filterTrainingMaterials(this, 'type')" data-value="all" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">
                                            {{ __('All') }}
                                        </li>

                                        <li onclick="filterTrainingMaterials(this, 'type')" data-value="file" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">
                                            {{ __('File') }}

                                        </li>

                                        <li onclick="filterTrainingMaterials(this, 'type')" data-value="url" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">
                                            {{ __('URL') }}
                                        </li>

                                        <li onclick="filterTrainingMaterials(this, 'type')" data-value="text" class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer">
                                            {{ __('Text') }}
                                        </li>
                                    </ul>
                                </div>

                                <!-- Training Filter -->
                                <div class="relative w-full lg:w-[145px] custom-select">
                                    <button type="button"
                                        class="select-btn w-full flex justify-between items-center px-4 py-2.5 text-sm rounded-lg border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition"
                                    >
                                        <span class="selected-option filter-state">{{ __('All') }}</span>
                                        <svg
                                            class="w-4 h-4 text-gray-400 dark:text-gray-300"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19 9l-7 7-7-7"
                                            />
                                        </svg>
                                    </button>

                                    <ul
                                        class="select-menu absolute hidden mt-1 w-full bg-white dark:bg-color-33 border border-color-DF dark:border-color-47 rounded-lg shadow-lg overflow-hidden z-20"
                                    >
                                        <li onclick="filterTrainingMaterials(this, 'state')" data-value="all"
                                            class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer"
                                        >
                                            {{ __('All') }}
                                        </li>
                                        <li onclick="filterTrainingMaterials(this, 'state')" data-value="trained"
                                            class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer"
                                        >
                                            {{ __('Trained') }}
                                        </li>
                                        <li onclick="filterTrainingMaterials(this, 'state')" data-value="untrained"
                                            class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-color-F6 dark:hover:bg-color-3A cursor-pointer"
                                        >
                                            {{ __('Untrained') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Right Section (Buttons) -->
                            <div
                                class="flex flex-wrap sm:flex-nowrap items-center gap-3 w-full sm:w-auto"
                            >
                            <form action="{{ route('user.marketing-bot.campaigns.material.export') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit"
                                       class="flex items-center gap-2 px-4 py-2.5 text-sm rounded-lg whitespace-nowrap border border-color-DF dark:border-color-47 hover:border-color-89 dark:hover:border-color-89 bg-white dark:bg-color-33 text-gray-700 dark:text-gray-200 focus:outline-none transition w-full sm:w-auto justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-4 h-4">
                                        <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    {{ __('Export CSV') }}
                                </button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div id="materials-table-container">
                    @include('marketingbot::materials.materials-table')
                </div>
                <!-- End Table -->

                <!-- Materials Table Skeleton -->
                @include('marketingbot::skeleton.materials-table-skeleton')
            </div>

        </div>
    </main>
@endsection

@section('js')
    <script type="text/javascript">
        window.route = "{{ route('user.marketing-bot.campaigns.materials', ['id' => request()->id ]) }}";
    </script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/campaign-materials.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
    <script src="{{ asset('Modules/MarketingBot/Resources/assets/js/marketing-bot-utils.min.js') }}?v={{ config('artifism.version', '1.0.0') }}"></script>
@endsection